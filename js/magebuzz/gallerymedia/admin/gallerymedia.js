/********Js For gallerymedia************/function useYoutube() {  if ($('use_youtube').checked) {    $('rowYoutube').show();    $('gallerymedia_item_file').disable();  }  else {    $('rowYoutube').hide();    $('gallerymedia_item_file').enable();  }}function changeSelect() {  if ($('gallerymedia_media_type').value == 2) {    $('upload_comment').show();  } else {    $('upload_comment').hide();    $('gallerymedia_item_file').enable();  }}document.observe("dom:loaded", function () {  var trElement = $('gallerymedia_video_url').parentElement.parentElement;  trElement.id = 'rowYoutube';  trElement.hide();  if ($('gallerymedia_media_type').value == 1) {    $('upload_comment').hide();  } else {    if ($('gallerymedia_video_url').value == '') {      $('use_youtube').checked = false;    }    else {      $('use_youtube').checked = true;    }    $('upload_comment').show();    useYoutube();  }});