@extends('layouts.contents')
@section('headerlinks')
<link rel="stylesheet" href="{{asset('css/style2.css')}}">
@endsection
@section('section')



<section class="center-area" id="detail-overview">
	<section class="home-inner">
		<div class="dor-left" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine"
			data-aos-duration="1500">
			<div class="map-area" id="cityMap">

			</div>
			<h4>State of Nevada</h4>
			<p>Select a county on the map above to access key market metrics or click <a href="javascript:void(0);"
					class="reloads">here</a> to obtain data for the entire state.</p>
		</div>
		<div class="dor-right" data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine"
			data-aos-duration="1500">
			<h4 id="pdfOver">Nevada Overview</h4>
			<div id="objPdfSpan"><embed id="objPdf" width="100%" height="481"
					pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" alt="pdf"
					src="pdf/Nevada.pdf#view=FitH"></div>
			<div class="btn-margin">
				<a href="pdf/Nevada.pdf" target="_blank" id="overviewPdf"><button class="btn">Download <span
							id="cityPd">nevada</span> overview report [PDF] <i class="ms-2 fa fa-file-pdf-o"
							aria-hidden="true"></i></button></a>
			</div>
		</div>
		<div class="clear"></div>
	</section>
</section>

@endsection