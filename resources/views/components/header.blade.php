@props([
'title',
])

<main>
    <header class="page-header">
        <h2>{{ $title }}</h2>
        <div class="right-wrapper text-end mx-2">

            <ol class="breadcrumbs">
                {{ $slot }}
                <li>
                    <a href="#" onclick="window.history.go(-1); return false;" class="btn btn-purple text-light"><i class="fa fa-reply mr5"></i> Back</a>
                </li>
            </ol>
        </div>
    </header>
</main>
