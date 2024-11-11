<main>
    <x-header title="Guidelines"></x-header>
    <section class="card">
        <div class="card-body">
            <div class="row mb-4 mx-4">
                <ol class="list-group list-group-flush">
                    @foreach($documentTypes as $type)
                        @foreach($type->supportDocuments as $document)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h4 class="text-primary">{{$document->file_name}}</h4>
                                <button class="btn btn-sm btn-primary" onclick="downloadFile('{{ asset('app/Admin/SupportDocument/'.\Carbon\Carbon::parse($document->created_at)->format('Ymd').'/'.$document->file_name) }}')">
                                Download <i class="fas fa-download"></i>
                                </button>
                            </li>
                        @endforeach
                    @endforeach
                </ol>
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