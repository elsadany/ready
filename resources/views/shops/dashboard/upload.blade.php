@extends('shops.layout.master')

@section('content')
@breadcrumb([
'title'=>'أنشاء صنف',
'links'=>[
'القائمة'=>'./shop/avalibilty',
'انشاء'=>''
]
])
<section id="content-body">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                @success
                @errors
                 <div class="container" style="  margin:70px auto">
      
          
        <div id="status"></div>
        <div class="uploader ">
    <img src="./assets/images/loading.gif" style="display: none" id="{name}-loading"/>
    <img src="profile_picture" id="image" class="image-upload" width="120" height="120" />
    <br/>
   <a href="javascript:void(0)" class="file-input btn btn-primary">
        <input type="file"  class="img-upload-input-bs" editor="#img-upload-panel" target="#image" status="#status" passurl="" pshape="square" w=300 h=300 size="{150,150}">
   </a>
</div>
        

               
                <div class="modal fade" id="img-upload-panel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Upload Profile Photo</h4>
            <button type="button" class="img-remove-btn-bs close">&times;</button>
        </div>
        <div class="modal-body">
            <div class="row container">
            <div class="col">
                <div class="img-edit-container"></div>
            </div>
            </div>
            <div class="row container">
            <div class="col">
                <label>Brightness</label>
                <input type="range" class="form-control-range filter" min=0 max=200 value=100 step=1 filter="brightness"/>
            </div>
            <div class="col">
                <label>Threshold</label>
                <input type="range" class="form-control-range filter" min=0 max=200 value=100 step=1 filter="threshold"/>
            </div>
            </div>
            <div class="row container">
            <div class="col">
                <button type="button" class="btn btn-dark filter" filter="grayscale">Grayscale</button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-dark filter" filter="sharpen">Sharpen</button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-dark filter" filter="blur">Blur</button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-dark img-clear-filter">Clear</button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-dark img-rotate-left">Rotate Left</button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-dark img-rotate-right">Rotate Right</button>
            </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary img-remove-btn-bs">Close</button>
            <button type="button" class="btn btn-primary img-upload-btn-bs">Upload</button>
        </div>
        </div>
    </div>
    </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('css')
 <link rel="stylesheet" href="{{url('imguploader/croppie.css')}}">
@endpush
@push('script')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{url('imguploader/croppie.min.js')}}"></script>
    <script src="{{url('imguploader/imguploader.bs.js')}}"></script>
@endpush