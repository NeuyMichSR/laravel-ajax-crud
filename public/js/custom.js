function readURL(input, selector) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(selector).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}


$('.img-clickable.feature-img').click(function(){
	$('input.feature-image').click();
});
$('input.feature-image').change(function(){
    readURL(this, 'img.feature-image');
});

// icon
$('.img-clickable.icon-img').click(function(){
    $('input.icon-image').click();
});
$('input.icon-image').change(function(){
    readURL(this, 'img.icon-image');
});
// end icon

// panoramic
$('.img-clickable.panoramic-img').click(function(){
    $('input.panoramic-image').click();
});
$('input.panoramic-image').change(function(){
    readURL(this, 'img.panoramic-image');
});
// end panoramic

// start multiple images
// function clickedImage(id){
//    if(typeof id !== undefined){
//     alert(id);
//     $('.input-image-'+id).click();
//    }
// }
// $('img.images').click(function(){
//     console.log($(this).attr('row'));
// });
// $('input.images').change(function(){
//     readURL(this, 'img.images');
// });
// end multiple image