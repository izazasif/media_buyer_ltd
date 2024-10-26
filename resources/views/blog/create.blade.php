@extends('auth.main')
@section('content')
<div class="content-wrapper">
        <section class="content">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    {{ session('message') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                    @foreach ($errors->all() as $error)
                        <li><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> &nbsp;{{ $error }}
                        </li>
                    @endforeach
                </div>
            @endif
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create New Article</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                       
                        <div class="box-body">
                            <div class="row"> 
                                <form role="form" method="POST" action="{{route('article.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                                <label for="exampleInputEmail1"> Select Category </label>
                                                    <select name="category_id" id="mySelect1" class="form-control" >
                                                    <option value=""> Select Category</option>
                                                    @foreach($cat as $cats)
                                                    <option value="{{$cats->id}}">{{$cats->name}}</option>
                                                    @endforeach
                                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Main Image (Multiple) </label>
                                        <input type="file" class="form-control" name="files[]" multiple
                                        accept=".jpg, .jpeg, .png" required>
                                        @if ($errors->has('main_image'))
                                            <span class="text-danger">{{ $errors->first('main_image') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reel">Upload Reel: (single reel)</label>
                                        <input type="file" name="reel" class="form-control" accept=".mp4" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="box-footer" style="text-align: right;">
                                        <button type="submit" class="btn btn-primary" onclick="submitForm(this);"><i class="fa fa-save"></i> Save</button>
                                        
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                            <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>
    <script>
        function submitForm(btn) {
        // disable the button
        btn.disabled = true;
        // submit the form    
        btn.form.submit();
    }
    var editor = new FroalaEditor('#example', {
                useClasses: false,
                imageUploadURL: '{{ route('froala.upload') }}',
            imageUploadParams: {
                // You can pass additional parameters here if needed
                _token: '{{ csrf_token() }}'
            }
    });
                

    document.getElementById('keyword-input').addEventListener('input', function() {
        const inputValue = this.value;
        const keywordsArray = inputValue.split(',').map(keyword => keyword.trim()).filter(keyword => keyword !== '');

        console.log(keywordsArray);  // This will log the array of keywords

        // If needed, you can handle the array further, e.g., storing or processing it
    });
    document.getElementById('title-input').addEventListener('input', function () {
        let title = this.value;

        // Function to create a slug from the title
        let slug = title
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')  // Remove all non-alphanumeric characters except spaces and hyphens
            .trim()
            .replace(/\s+/g, '-')         // Replace spaces with hyphens
            .concat('-' + Math.floor(Math.random() * 999999 + 1)); // Append random number at the end

        // Set the generated slug in the slug input field
        document.getElementById('slug-input').value = slug;
    });
    </script>
@endsection


                               