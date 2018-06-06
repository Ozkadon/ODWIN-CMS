<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
	$breadcrumb[0]['url'] = url('backend/dashboard');
	$breadcrumb[1]['title'] = 'Pages';
	$breadcrumb[1]['url'] = url('backend/pages');	
	$breadcrumb[2]['title'] = 'Add';
	$breadcrumb[2]['url'] = url('backend/pages/create');
	if (isset($data)){
		$breadcrumb[2]['title'] = 'Edit';
		$breadcrumb[2]['url'] = url('backend/pages/'.$data[0]->id.'/edit');
	}
?>

<?php
	$cover_1 = [];
	if (isset($data)){
		$cover_1 = $data[0];
		$cover_1->field = 'featured_image';
	}
?>

<!-- LAYOUT -->
@extends('backend.layouts.main')

<!-- TITLE -->
@section('title')
	<?php
		$mode = "Create";
		if (isset($data)){
			$mode = "Edit";
		}
	?>
    Pages - <?=$mode;?>
@endsection

<!-- CONTENT -->
@section('content')
	<?php
        $judul = old('judul');
        $featured_image = 0;
        $caption_img = old('caption_img');
        $detail = old('detail');
		$active = 1;
		$method = "POST";
		$mode = "Create";
		$url = "backend/pages/";
		if (isset($data)){
            $judul = $data[0]->judul;
            $featured_image = $data[0]->featured_image;
            $caption_img = $data[0]->caption_img;
            $detail = $data[0]->detail;
			$active = $data[0]->active;
			$method = "PUT";
			$mode = "Edit";
			$url = "backend/pages/".$data[0]->id;
		}
	?>
	<div class="page-title">
		<div class="title_left">
			<h3>Pages - <?=$mode;?></h3>
		</div>
		<div class="title_right">
			<div class="col-md-4 col-sm-4 col-xs-8 form-group pull-right top_search">
                @include('backend.elements.back_button',array('url' => '/backend/pages'))
			</div>
        </div>
        <div class="clearfix"></div>
		@include('backend.elements.breadcrumb',array('breadcrumb' => $breadcrumb))
	</div>
	<div class="clearfix"></div>
	<br/><br/>	
	<div class="row">
		<div class="col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					{{ Form::open(['url' => $url, 'id' => 'submitForm', 'method' => $method,'class' => 'form-horizontal form-label-left', 'files' => true]) }}
						{!! csrf_field() !!}
						<div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Title <span class="required">*</span></label>
							<div class="col-sm-7 col-xs-12">
								<input type="text" name="judul" required="required" class="form-control" value="<?=$judul;?>" autofocus>
							</div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-sm-3 col-xs-12">Image</label>
                            <div class="col-sm-6 col-xs-9">
                                <input type="hidden" name="featured_image" value=<?=$featured_image;?> id="id-cover-image_1">
                                @include('backend.elements.change_cover',array('cover' => $cover_1, 'id_count' => 1))	
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-sm-3 col-xs-12">Image caption </label>
                            <div class="col-sm-5 col-xs-12">
                                <input type="text" name="caption_img" class="form-control" value="<?=$caption_img;?>" autofocus>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-sm-3 col-xs-12">Status: </label>
                            <div class="col-sm-5 col-xs-12">
                                {{
                                Form::select(
                                    'active',
                                    ['1' => 'Active', '2' => 'Deactive'],
                                    $active,
                                    array(
                                        'class' => 'form-control',
                                    ))
                                }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-xs-12">Content</label>
                            <div class="col-sm-12 col-xs-12">
                                <textarea name="detail" id="editor_1" rows="10" cols="80" class="form-control"><?=$detail;?></textarea>
                            </div>
                        </div>                              
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-sm-6 col-xs-12 col-sm-offset-3">
                                <a href="<?=url('/backend/pages')?>" class="btn btn-warning">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</a>
							</div>
						</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@endsection

<!-- CSS -->
@section('css')

@endsection

<!-- JAVASCRIPT -->
@section('script')
    <script src="<?=url('vendors/ckeditor/ckeditor.js');?>"></script>
    <script>
        CKEDITOR.replace( 'editor_1', {
            filebrowserBrowseUrl: '<?=url("backend/media-library/popup-media-editor/1");?>',
		    height : 500,
    	});
    </script>        
@endsection