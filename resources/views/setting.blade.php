<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting Media</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            max-width: 100%;
            width: calc(100% - 40px); /* Account for margins */
            box-sizing: border-box;
        }

        h5 {
            margin: 10px 0;
        }

        input[type="text"],
        input[type="file"],
        button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button-container2 {
            display: flex;
            justify-content: right;
            margin-top: 20px;
        }

        .button-container button {
            width: auto;
            padding: 10px 20px;
            margin: 0;
        }
        .button-container2 button {
            width: auto;
            padding: 10px 20px;
            margin: 0;
        }

        .center-button {
            margin: 0 auto;
        }

        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 10px;
        }

        .video-preview {
            width: 200px;
            height: 113px;
            background-color: #000;
            margin: 10px 0;
        }
        .video-preview video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .image-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 10px; /* Space between images */
        }

        .image-item {
            position: relative;
            width: 100px; /* Width of the preview image */
            height: 100px; /* Height of the preview image */
            overflow: hidden;
        }

        .image-preview {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Adjusts the image to cover the container */
        }

        .delete-button {
            display: block;
            text-align: center;
            margin-top: 5px;
            color: red;
            font-size: 12px;
        }

        .delete-button:hover {
            text-decoration: underline;
        }
        .image-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 10px; /* Space between images */
    }

    .image-item {
        position: relative;
        width: 100px; /* Width of the preview image */
        height: 100px; /* Height of the preview image */
        overflow: hidden;
    }

    .image-preview {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Adjusts the image to cover the container */
    }

    .remove-button {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: rgba(0, 0, 0, 0.6); /* Dark background for better visibility */
        color: white;
        border-radius: 50%;
        width: 20px; /* Width of the button */
        height: 20px; /* Height of the button */
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
    }

    .remove-button:hover {
        background-color: rgba(0, 0, 0, 0.8); /* Slightly darker on hover */
    }

    </style>
</head>
<body>

<div class="card">
    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif
    <div class="card-header">
        <h2>Setting Media</h2>
    </div>
    <form action="{{ url('/setting/update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h5>Youtube URL</h5>
        <input type="text" name="url" value="{{ $media->url ?? null }}">
        <h5>Video File</h5>
        <input type="file" name="video">
        @if($media && $media->video)
            <div class="video-preview">
                <video controls>
                    <source src="{{ route('video', $media->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <a name="delete_video"  href="{{ route('delete.video') }}"class="delete-button">Delete Video</a>
            </div>
        @endif
        <br>
        <h5>Images</h5>
        @if($media && $media->images)
        @php $images= json_decode($media->images); @endphp
            <div class="image-gallery">
                @foreach ($images as $image)
                    <div class="image-item">
                        <img src="{{ route('image', $image) }}" alt="" class="image-preview">
                        <a name="remove_image" href="{{ route('delete.image',['name'=>$image]) }}" class="remove-button">X</a>
                    </div>
                @endforeach
            </div>
        @endif
        <div id="imageInputs">
            <input type="file" name="file[]" show image name file > 
        </div>
       
        <div class="button-container">
            <button type="button" id="addImageButton" class="center-button">Add Another Image</button>
        </div>
        <h5>Footer Moving Text</h5>
        <input type="text" name="footer" value="{{ $media->footer ?? null }}">
        <div class="button-container2">
            <button type="submit">Save Media</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('addImageButton').addEventListener('click', function() {
        const imageInputs = document.getElementById('imageInputs');
        const newInput = document.createElement('input');
        newInput.type = 'file';
        newInput.name = 'file[]';
        imageInputs.appendChild(newInput);
    });
</script>

</body>
</html>
