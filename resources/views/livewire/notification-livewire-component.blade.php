<main>
    <x-header title="Notifications"></x-header>
    <section class="card">
        <div class="card-body">
            <div class="row mb-4 mx-4">
                <div class="col-12">
                    <ol class="list-group list-group-flush">
                        @foreach($documentType as $type)
                            @foreach($type->supportDocuments as $document)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <h4 class="mb-0"
                                        style="color: {{ $document->file_name ? '#007bff' : 'black' }};">
                                        {{ $document->file_name ?: $document->name }}
                                    </h4>
                                    @if ($document->file_name)
                                        <button class="btn btn-sm btn-primary" onclick="downloadFile('{{ asset('app/Admin/SupportDocument/'.\Carbon\Carbon::parse($document->created_at)->format('Ymd').'/'.$document->file_name) }}')">
                                            Download <i class="fas fa-download"></i>
                                        </button>
                                    @else
                                        <span class="text-muted"></span>
                                    @endif
                                </li>
                            @endforeach
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    function downloadFile(url) {
        const link = document.createElement('a');
        link.href = url;
        link.download = url.substring(url.lastIndexOf('/') + 1);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
