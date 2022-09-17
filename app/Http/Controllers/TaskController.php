<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewTaskMail;
use App\Exports\TaskExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class TaskController extends Controller
{
    /**
     * Form variables rules 
     */
    protected $rules = [
        'task'     => 'required',
        'deadline' => 'required|date',
    ];

    /**
     * Form variables feedback
     */
    protected $feedback = [
        'deadline.date' => 'Deadline value is not a valid date',
        'required'      => 'The field :attribute is required',
    ];

    /**
     * Array of allowed extensions for export
     * 
     * @var array
     */
    protected $exportExtensions = ['xlsx', 'csv', 'pdf'];

    /**
     * Create a new controller instance
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**

     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $taskObjList = Task::where('user_id', $userId)->paginate(2);

        return view('task.index', [
            'list' => $taskObjList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->rules, $this->feedback);

        $objData = $request->all('task', 'deadline');
        $objData['user_id'] = auth()->user()->id;

        $task = Task::create($objData);

        $this->sendNewTaskEmail($task);

        return redirect()->route('task.show', ['task' => $task->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return ($this->checkUserAccess($task))
            ? view('task.show', ['task' => $task])
            : view('access-denied');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return ($this->checkUserAccess($task))
            ? view('task.edit', ['task' => $task])
            : view('access-denied');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        if (!$this->checkUserAccess($task))
            return view('access-denied');

        $request->validate($this->rules, $this->feedback);

        $task->update($request->all());

        return redirect()->route('task.show', ['task' => $task->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if (!$this->checkUserAccess($task))
            return view('access-denied');

        $task->delete();

        return redirect()->route('task.index');
    }

    /**
     * Export a tasklist according to the requested file format.
     * 
     * @param  string $extension
     * @return mixed???
     */
    public function export(string $extension)
    {
        $fileName = 'tasklist';

        return ($this->validExtensionFormat($extension))
            ? Excel::download(new TaskExport, "$fileName.$extension")
            : redirect()->route('task.index');
    }

    /**
     * method responsible for ...
     * 
     * @return
     */
    public function exportPDF()
    {
        $taskCollection = auth()->user()->tasks()->get();
        $userName = auth()->user()->name;

        $pdf = PDF::loadView('task.pdf', [
            'taskCollection' => $taskCollection,
            'username' => $userName ?? '',
        ]);
        
        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream('tasklist.pdf');
        // return $pdf->download('tasklist.pdf');
    }

    /**
     * Validate if a task belongs to current user.
     * 
     * @param  Task $task
     * @return bool
     */
    private function checkUserAccess(Task $task)
    {
        return ($task->user_id == auth()->user()->id);
    }

    /**
     * Send an email informing the task creation.
     * 
     * @param  Task $task
     * @return void
     */
    private function sendNewTaskEmail(Task $task)
    {
        $receiver = auth()->user()->email;
        Mail::to($receiver)->send(new NewTaskMail($task));
    }

    /**
     * Check whether the requested file format is valid or not.
     * 
     * @param  string $extension
     * @return bool
     */
    private function validExtensionFormat(string $extension)
    {
        return in_array($extension, $this->exportExtensions);
    }
}
