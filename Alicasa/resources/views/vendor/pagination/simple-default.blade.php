<style>
    .pagination{
        text-align: center;
    }
    .pagination a:visited {
        color:black;
    }

    .pagination a{
        border-radius: 5px;
        background-color: white;
        border: 2px solid black;
        font-weight: bold;
        cursor: pointer;
        color:black;
        padding: 4px 12px;
        transition: all 0.3s ease-in-out;
    }
    .pagination a:hover{
        background-color: #009FA8;
        color: white;
        border-color:#009FA8;
        transform: scale(1.05);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

</style>
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="disabled" aria-disabled="true"><span>Anterior</span></a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">Anterior</a>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next">Siguiente</a>
            @else
                <a class="disabled" aria-disabled="true"><span>Siguiente</span>
            @endif
        </ul>
    </nav>
@endif
