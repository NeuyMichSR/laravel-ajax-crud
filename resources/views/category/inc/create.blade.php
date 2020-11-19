<!-- The Modal -->
<div class="modal" id="AddCategoryModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form id="frmData" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Category Name:</label>
                    <input type="text" class="form-control" placeholder="Enter name" id="name" name="name">
                </div>
                {{-- <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control" placeholder="Enter password" id="image" name="image">
                </div> --}}
                <div class="form-group {{$errors->has('image') ? 'has-error' : ''}} text-center">
                    <br>
                    <img id="preview" src="{{ asset('images/noimage.jpg') }}" height="150px"/><br/>
                    <input type="file" id="image" style="display: none;" name="image"  />
                    <!--<input type="hidden" style="display: none" value="0" name="remove" id="remove">-->
                    <a href="javascript:getImage()">Upload</a> |
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
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="btnClose">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Save</button>
        </form>
        </div>

      </div>
    </div>
  </div>
