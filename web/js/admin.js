$(document).ready(function(){
    seoResult();

});

function seoResult()
{
    var title = $('input#blog-title').val();
    var description = $('#blog-description').val();

    var blog_id = $('input#blog-id').val();
    var blog_slug = $('input#blog-slug').val();
    var post_url = 'http://site-name/blog/show/';

    $('#meta_title_result').text(title);
    $('#meta_url_result').text(post_url+blog_slug);

    $('#meta_desc_result').text(description+'...');

        $('input#blog-title').keyup(function(){
            title = $(this).val();
            $('#meta_title_result').text(title);
        });

        $('#blog-description').keyup(function(){

            description = $(this).val();
            $('#meta_desc_result').text(description+'...');
        });





}