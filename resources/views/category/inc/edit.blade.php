<!-- The Modal -->
<div class="modal" id="EditCategoryModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form id="frmEdit" action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Category Name:</label>
                    <input type="text" class="form-control" placeholder="Enter name" id="ename" name="name">
                </div>
                {{-- <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control" id="eimage" name="image">
                    <input type="hidden" class="form-control" id="old_image" name="old_image">
                    <input type="hidden" class="form-control" id="cat_id" name="cat_id">
                </div> --}}
                <div class="form-group {{$errors->has('image') ? 'has-error' : ''}} text-center">
                    <br>
                    <div id="showImage"></div>
                    <div id="showImageUpdate"></div>
                    <img id="preview" src="{{ asset('images/noimage.jpg') }}" height="150px"/><br/>
                    <input type="file" id="eimage" style="display: none;" name="image"  />
                    <input type="hidden" class="form-control" id="old_image" name="old_image">
                    <input type="hidden" class="form-control" id="cat_id" name="cat_id">
                    <a href="javascript:updateImage()">Upload</a> |
                    <a style="color: red" href="javascript:removeImage()" id="remove">Remove</a>
                    @if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                    @endif
                </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="btnEditClose">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </form>
        </div>

      </div>
    </div>
</div>
