@extends('layouts.uapp')
 
@section('sub-content')
<div class="pt-40" style="background-color: #f8f8f8">
    <div id="viewport" class="w-full overflow-hidden relative p-0 ">
        {{-- <div style="position: absolute; width: 687px; height: 207775px; left: 331px;"> --}}
            <iframe src="{{ route('content.file', ['id' => 'qbFRaFRTIKZzQdUM', 'ext' => 'pdf']) }}" width="100%" height="600"></iframe>
        {{-- </div> --}}
    </div>
</div>
@endsection