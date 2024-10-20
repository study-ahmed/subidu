<!doctype html>
<html lang="en">
<head>
    <title>Image Upload and Gallery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   
</head>
<style>
    body {
    background-color: #f0f2f5;
    font-family: Arial, sans-serif;
}

.card {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    overflow: hidden;
}

.btn-primary {
    background-color: #4267B2;
    border-color: #4267B2;
}

.btn-danger {
    background-color: #E4405F;
    border-color: #E4405F;
}

.upload-btn-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
    width: 100%;
    height: 250px;
    margin-bottom: 20px;
}

.upload-btn {
    border: 3px dashed #4267B2;
    color: #4267B2;
    background-color: #F0F2F5;
    padding: 20px;
    border-radius: 15px;
    font-size: 24px;
    font-weight: bold;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.upload-btn-wrapper input[type=file] {
    font-size: 100px;
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

#preview-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: none;
    border-radius: 15px;
}

.card-header {
    background-color: #4267B2;
}

.card-title {
    color: #4267B2;
}

.alert {
    border-radius: 10px;
}
</style>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="text-center mb-0">Image Upload</h4>
                    </div>
                    <div class="card-body text-center">
                        <form action="#" method="post" enctype="multipart/form-data" id="upload-form">
                            <div class="upload-btn-wrapper">
                                <div class="upload-btn" id="upload-btn">
                                    <i class="fas fa-cloud-upload-alt fa-3x mb-3"></i><br> 
                                    Click or Drag to Upload Image
                                </div>
                                <img id="preview-image" src="#" alt="Preview">
                                <input type="file" name="imageUpload" accept="image/*" required id="file-input">
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block mt-3">Submit</button>
                        </form>
                        <?php
                        if (isset($_FILES['imageUpload'])) {
                            $upload = move_uploaded_file($_FILES['imageUpload']['tmp_name'], "Upload/".$_FILES['imageUpload']['name']);
                            echo $upload ? "<div class='alert alert-success mt-3'>Image uploaded successfully</div>" : "<div class='alert alert-danger mt-3'>Image upload failed</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4 border-bottom pb-2" style="color: #4267B2;">Image Gallery</h2>
        <div class="row">
            <?php
            $images = glob("Upload/*.{jpg,jpeg,png,gif}", GLOB_BRACE);
            foreach($images as $image) {
                $imageName = basename($image);
                echo "<div class='col-md-4 mb-4'>
                        <div class='card h-100'>
                            <img src='$image' class='card-img-top' alt='$imageName' style='height: 250px; object-fit: cover;'>
                            <div class='card-body d-flex flex-column'>
                                <h5 class='card-title text-truncate' title='$imageName'>$imageName</h5>
                                <div class='mt-auto d-flex justify-content-between'>
                                    <a href='$image' class='btn btn-primary btn-sm' target='_blank'><i class='fas fa-eye'></i> View</a>
                                    <form action='' method='post'>
                                        <input type='hidden' name='delete_image' value='$image'>
                                        <button type='submit' class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>";
            }
            if(isset($_POST['delete_image']) && file_exists($_POST['delete_image'])) {
                unlink($_POST['delete_image']);
                echo "<script>window.location.reload();</script>";
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="Script.js"></script>
</body>
</html>