@extends('layouts.uapp')
 
@section('sub-content')
<div class="pt-40" style="background-color: #f8f8f8">
        {{-- <div style="position: absolute; width: 687px; height: {{ $files != 'x' ? count($files)*1138+5 : 1138 }}px; left: 331px;"> --}}
            {{-- <iframe src="{{ route('content.file', ['id' => 'qbFRaFRTIKZzQdUM' ]) }}" width="100%" height="600"></iframe> --}}
        {{-- </div> --}}

        <div style="position: absolute; display: none; z-index: 10000; width:360px; text-align:left;">
            <div style="cursor: default; width: 340px; background:#fff; border:1px solid #d9d9d9; "></div>
        </div>
        <div id="volume-center">
            <div id="scroll_atb" role="main">
                <div class="gback">
                    <div id="viewport" class="viewport" tabindex="0" style="overflow: hidden; position: relative; padding: 0px;">
                        <div class="m-auto overflow-scrolling" dir="ltr" style="box-sizing: content-box; width: 710px; height: 800px; position: relative; overflow: auto scroll;">
                            <div class="scroll-background" style="height: {{ $files != 'x' ? count($files)*1138+5 : 1138 }}px;">
                                <div style="position: absolute; width: 687px; height: {{ $files != 'x' ? count($files)*1138+5 : 1138 }}px; left: 0px;">

                                    @if($files != 'x')
                                        @foreach($files as $index=>$file)
                                            <div style="position: absolute; left: 0px; top: {{ 1138*$index }}px;">
                                                <div style="background-color: rgb(204, 204, 204); position: absolute; left: 0px; top: 0px; width: 687px; height: 1135px;">
                                                    <div class="pageImageDisplay" style="overflow: hidden; background-color: rgb(252, 252, 252); position: absolute; left: 1px; top: 1px; width: 685px; height: 1133px; user-select: none; pointer-events:none;">
                                                        <div style="position: absolute; left: 0px; top: 0px; background-color: rgb(255, 255,255); width: 685px; height: 1133px; user-select: none; pointer-events:none;"></div>
                                                        
                                                        <div style="position: absolute; left: 0px; top: 0px; user-select: none; pointer-events:none;">
                                                            <img width="685" style="user-select: none; pointer-events:none;" src="{{ route('content.files', ['file'=>$file->image_path]) }}">
                                                        </div>
                                                        <div style="position: absolute; left: 0px; top: 0px; user-select: none; pointer-events:none;"></div>
                                                        <div style="position: absolute; left: 0px; top: 0px; width: 685px; height: 1053px; user-select: none; pointer-events:none;"></div>
                                                        <div style="position: absolute; left: 0px; top: 0px;"></div>
                                                        <div style="position: absolute; left: 0px; top: 0px;"></div>
                                                        <div style="position: absolute; left: 0px; top: 0px; width: 685px; height: 1053px;">
                                                            <div class="selection-layer" style="width: 685px; height: 1053px;"></div>
                                                        </div>
                                                        <div style="position: absolute; left: 0px; top: 0px; cursor: pointer;"></div>
                                                        <div style="position: absolute; left: 0px; top: 0px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        {{-- <iframe src="{{ route('content.file', ['id' => $book->file_ebook]) }}" width="100%" height="600" frameborder="0" toolbar="0" menu="0"></iframe> --}}
                                        <canvas id="pdfContainer" data-item="{{ $book->file_ebook }}" width="685px" height="1135px"></canvas>
                                    @endif
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.3.122/build/pdf.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var pdfjsLib = window['pdfjs-dist/build/pdf'];
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdn.jsdelivr.net/npm/pdfjs-dist@3.3.122/build/pdf.worker.min.js';

        // The URL of the PDF file
        const pdfCanvas = document.getElementById('pdfContainer');
        var url = "/content/file?id=" + pdfCanvas.getAttribute('data-item');
        console.log(url);


        // Asynchronously fetch the PDF file
        pdfjsLib.getDocument(url).promise.then(function(pdf) {
            pdf.getPage(1).then(function(page) {
                // Set the scale of the viewport to fit the canvas size
                var viewport = page.getViewport({scale: pdfCanvas.width / page.getViewport({scale: 1.0}).width});
                
                // Render the page on the canvas
                var renderContext = {
                    canvasContext: pdfCanvas.getContext('2d'),
                    viewport: viewport
                };
                page.render(renderContext);
            });
        });
    });

</script>

@endsection