@extends('layouts.uapp')
 
@section('sub-content')
<div class="pt-40" style="background-color: #f8f8f8">
        {{-- <div style="position: absolute; width: 687px; height: 207775px; left: 331px;"> --}}
            {{-- <iframe src="{{ route('content.file', ['id' => 'qbFRaFRTIKZzQdUM' ]) }}" width="100%" height="600"></iframe> --}}
        {{-- </div> --}}

        <div style="position: absolute; display: none; z-index: 10000; width:360px; text-align:left;">
            <div style="cursor: default; width: 340px; background:#fff; border:1px solid #d9d9d9; "></div>
        </div>
        <div id="volume-center">
            <div id="scroll_atb" role="main">
                <div id="search_bar"></div>
                <div class="gback">
                    <div id="viewport" class="viewport" tabindex="0" style="overflow: hidden; position; relative; padding: 0px;">
                        <div class="m-auto overflow-scrolling" dir="ltr" style="box-sizing: content-box; width: 710px; height: 800px; position: relative; overflow: auto scroll;">
                            <div class="scroll-background" style="height: 207775px; cursor: url("/googlebooks/iamges.openhand.cur") 7 5, default;">
                                <div style="position: absolute; width: 687px; height: 207775px; left: 0px;">
                                    <div style="position: absolute; left: 0px; top: 1063px;">
                                        <div style="position: absolute;"></div>
                                        </div>
                                        <div style="position: absolute; left: 0px; top: 0px;">
                                            <div style="position: absolute;"></div>
                                                <div style="background-color: rgb(204, 204, 204); position: absolute; left: 0px; top: 0px; width: 687px; height: 1055px;">
                                                    <div class="pageImageDisplay" style="overflow: hidden; background-color: rgb(252, 252, 252); position: absolute; left: 1px; top: 1px; width: 685px; height: 1053px; user-select: none; pointer-events:none;">
                                                        <div style="position: absolute; left: 0px; top: 0px; background-color: rgb(255, 255,255): width: 685px; height: 1053px; user-select: none; pointer-events:none;"></div>
                                                        <div style="position: absolute; left: 0px; top: 0px; width: 685px; height: 1053px; user-select: none; pointer-events:none; display: none;">
                                                            <div style="position: absolute; left: 0px; color: rgb(128, 128, 128); font-size: 13px; background-color: white; user-select: none; pointer-events:none;">Memuat..."</div>
                                                        <div style="position: absolute; left: 0px; color: rgb(128, 128, 128); font-size: 13px; background-color: white; bottom: 0px; user-select: none; pointer-events:none;">Memuat..."</div>
                                                        </div>
                                                        <div style="position: absolute; left: 0px; top: 0px; user-select: none; pointer-events:none;">
                                                            <img width="685" style="user-select: none; pointer-events:none;" src="https://books.google.co.id/books/content?id=do3RdULBQuYC&hl=id&pg=PR3&img=1&zoom=3&sig=ACfU3U39JXBP7mIQd8wnFZMdnAZ2l7I_Fg&w=1280">
                                                            <img width="685" style="user-select: none; pointer-events:none;" src="https://books.google.co.id/books/content?id=do3RdULBQuYC&hl=id&pg=PR3&img=1&zoom=3&sig=ACfU3U39JXBP7mIQd8wnFZMdnAZ2l7I_Fg&w=1280">
                                                        </div>
                                                        <div style="position: absolute; left: 0px; top: 0px; user-select: none; pointer-events:none;"></div>
                                                        <div style="position: absolute; left: 0px; top: 0px; width: 685px; height: 1053px; user-select: none; pointer-events:none;"></div>
                                                        <div style="position: absolute; left: 0px; top: 0px;"></div>
                                                        <div style="position: absolute; left: 0px; top: 0px;"></div>
                                                        <div style="position: absolute; left: 0px; top: 0px; width: 685px; heigt: 1053px;">
                                                            <div class="selection-layer" style="width: 685px; height: 1053px;"></div>
                                                        </div>
                                                        <div style="position: absolute; left: 0px; top: 0px; cursor: pointer;"></div>
                                                        <div style="position: absolute; left: 0px; top: 0px;"></div>
                                                    </div>
                                                </div>

                                                <div style="background-color: rgb(204, 204, 204); position: absolute; left: 0px; top: 0px; width: 687px; height: 1055px;">
                                                    <div class="pageImageDisplay" style="overflow: hidden; background-color: rgb(252, 252, 252); position: absolute; left: 1px; top: 1px; width: 685px; height: 1053px; user-select: none; pointer-events:none;">
                                                        <div style="position: absolute; left: 0px; top: 0px; background-color: rgb(255, 255,255): width: 685px; height: 1053px; user-select: none; pointer-events:none;"></div>
                                                        <div style="position: absolute; left: 0px; top: 0px; width: 685px; height: 1053px; user-select: none; pointer-events:none; display: none;">
                                                            <div style="position: absolute; left: 0px; color: rgb(128, 128, 128); font-size: 13px; background-color: white; user-select: none; pointer-events:none;">Memuat..."</div>
                                                        <div style="position: absolute; left: 0px; color: rgb(128, 128, 128); font-size: 13px; background-color: white; bottom: 0px; user-select: none; pointer-events:none;">Memuat..."</div>
                                                        </div>
                                                        <div style="position: absolute; left: 0px; top: 0px; user-select: none; pointer-events:none;">
                                                            <img width="685" style="user-select: none; pointer-events:none;" src="https://books.google.co.id/books/content?id=do3RdULBQuYC&hl=id&pg=PR3&img=1&zoom=3&sig=ACfU3U39JXBP7mIQd8wnFZMdnAZ2l7I_Fg&w=1280">
                                                            <img width="685" style="user-select: none; pointer-events:none;" src="https://books.google.co.id/books/content?id=do3RdULBQuYC&hl=id&pg=PR3&img=1&zoom=3&sig=ACfU3U39JXBP7mIQd8wnFZMdnAZ2l7I_Fg&w=1280">
                                                        </div>
                                                        <div style="position: absolute; left: 0px; top: 0px; user-select: none; pointer-events:none;"></div>
                                                        <div style="position: absolute; left: 0px; top: 0px; width: 685px; height: 1053px; user-select: none; pointer-events:none;"></div>
                                                        <div style="position: absolute; left: 0px; top: 0px;"></div>
                                                        <div style="position: absolute; left: 0px; top: 0px;"></div>
                                                        <div style="position: absolute; left: 0px; top: 0px; width: 685px; heigt: 1053px;">
                                                            <div class="selection-layer" style="width: 685px; height: 1053px;"></div>
                                                        </div>
                                                        <div style="position: absolute; left: 0px; top: 0px; cursor: pointer;"></div>
                                                        <div style="position: absolute; left: 0px; top: 0px;"></div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="position: absolute; left: 0px; top: 0px;">
                                <div style="background-color: rgb(252, 252, 252); position: absolute; width: 15px; hieght: 344px; left: 462px; top: 0px;">
                                    <div style="position: absolute; background-color: rgb(178, 196, 233); width: 100%; height: 5px; cursor: pointer; left: 0px; top: 165px;"></div>
                                </div>
                                <div style="white-space: nowrap; padding: 5px; border: 1px solid rgb(255, 245, 136); background-color: rgb(255, 255, 104); font-size: 13.28px; position: relative; display: none; left: 241px; top: 0px;"></div>
                                <div style=" background-color: rgb(170, 170,170); position: absolute; cursor: pointer; opacity: 0; width: 477px; height: 40px; left: 0px; top: 304px;">
                                    <div style="background-color: rgb(0, 0, 0); height: 1px; overflow: hidden;"></div>
                                    <div class="SPRITE_page_down" style="float: left; margin-left: 16px;"></div>
                                    <div class="SPRITE_page_down" style="float: left; margin-right: 16px;"></div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
</div>
@endsection