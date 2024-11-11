
<div class="header-nav collapse">
    <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 text-end">
        <nav>
            <ul class="nav nav-pills" id="mainNav">
                <li class="dropdown navbar-toggle">
                    <a class="nav-link" href="#">
                        Contact Us
                    </a>
                </li>
                <li class="dropdown navbar-toggle">
                    <a class="nav-link dropdown-toggle navbar-toggle" href="#">
                        DocumentTypes
                    </a>
                    <ul class="dropdown-menu">

                        @foreach($documentTypes as $type)
                            <li class="dropdown-submenu ">
                                <a class="nav-link">
                                    {{ $type->document_type_name }}
                                </a>
                                <ul class="dropdown-menu ">
                                    @foreach($type->supportDocuments as $document)
                                        <li>
                                            <a href="{{ asset("app/Admin/SupportDocument/".\Carbon\Carbon::parse($document->created_at)->format('Ymd')."/".$document->file_name) }}"
                                               class="nav-link" type="download">{{$document->file_name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>

                        @endforeach
                    </ul>
                </li>
                <span class="separator"></span>
            </ul>
        </nav>
    </div>
</div>
