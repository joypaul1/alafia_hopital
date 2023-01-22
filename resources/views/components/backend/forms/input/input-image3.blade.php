{{-- how to add your template --}}
{{-- @include('components.backend.forms.input.input-image3',[ 'name' => 'image', 'alert_text' =>'Image Will be (200x200)px.' ]) --}}

@push('css')

<style>
.fileUpload {
  position: relative;
  overflow: hidden;
  height: 43px;
  margin-top: 0;
}

.fileUpload input#uploadLogo {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  padding: 0;
  font-size: 20px;
  cursor: pointer;
  opacity: 0;
  filter: alpha(opacity=0);
  width: 100%;
  height: 42px;
}
</style>

@endpush
{{-- label start --}}
<label class="col-form-label" @isset($name) for="{{ $name }}" @endisset>
@php
    $str = ['_','[', ']'];
    $rplc =[' ',' ', ' '];
    $upName =  ucfirst(str_replace($str,$rplc, $name));
@endphp
    {{ucfirst($label??$upName)}}
    @isset($required)
    <span class="text-danger">*</span>
    @endisset
</label>
{{-- label end here --}}

<div class="input-group mb-3">
    {{-- <input type="file" name="file" class="form-control" id="fileName" value=""> --}}

    <div class="input-group-prepend fileUpload">
        <span class="input-group-text" id="basic-addon1">Browse File
        </span>
        <input type="file" name="file"   placeholder="Username" accept="image/*" id="uploadLogo">
    </div>
</div>

@isset($alert_text)
<strong class="text-danger text-bold"> {{$alert_text}} </strong>
@endisset



@push('js')
<script>
    $(document).ready(function($) {

        // Upload btn on change call function
        $("#uploadLogo").change(function() {
            var filename = readURL(this);
            $('#fileName').val(filename);
        });

        // Read File and return value  
        function readURL(input) {
            var url = input.value;
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (
                    ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "gif" || ext == "pdf"
                )) {
                var path = $(input).val();
                var filename = path.replace(/^.*\\/, "");
                // $('.fileUpload span').html('Uploaded Proof : ' + filename);
                return filename;
            } else {
                $(input).val("");
                return "Only image/pdf formats are allowed!";
            }
        }
        // Upload btn end
    });
</script>
@endpush