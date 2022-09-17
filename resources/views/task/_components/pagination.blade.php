<nav>
    <ul class="pagination justify-content-center">
        <li class="page-item {{ ($list->currentPage() == 1) ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $list->previousPageUrl() }}">Prev</a>
        </li>

        @for($i=1; $i<=$list->lastPage(); $i++)
            <li class="page-item {{ ($list->currentPage() == $i) ? 'active' : '' }}">
                <a class="page-link" href="{{ $list->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        
        <li class="page-item {{ ($list->currentPage() == $list->lastPage()) ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $list->nextPageUrl() }}">Next</a>
        </li>
    </ul>
</nav>