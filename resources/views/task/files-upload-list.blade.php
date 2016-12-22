@foreach( $files as $file )
    <div class="row">
        <div class="col-md-2">
            <a href="{{ url($file->url) }}" target="_blank" class="btn btn-success btn-xs">Preview</a>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-addon">Name</span><input type="text" style="width:100%;" class="files-name" data-task-id="{{ $task->id }}" data-file-id="{{ $file->id }}" value="{{ $file->name }}" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-addon">Description</span><input type="text" style="width:100%;" class="files-description" data-task-id="{{ $task->id }}" data-file-id="{{ $file->id }}" value="{{ $file->description }}" />
            </div>
        </div>
        <div class="col-md-2">
            <a class="btn btn-danger btn-xs delete-file" href="#" data-task-id="{{ $task->id }}" data-file-id="{{ $file->id }}">Delete</a>
        </div>
    </div>
@endforeach
