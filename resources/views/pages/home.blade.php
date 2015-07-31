@extends('templates.master')

@section('title', 'Home Page')

@section('content')
<style>
	#banner img {
		width:100%;
	}
	#header {
		margin-bottom:0;
	}
	#search {
	  background: #012345;
	  padding: 5px 0;
	}
	#search-control-container {
		background-color: #fff;
		height: 30px;
		margin-left: 10px;
		border-radius: 4px;
		overflow: hidden;
	}
	#searchForm {
		margin-bottom: 5px;
	}
	#stats table td {color: #eee;}
</style>
<div id="banner">
	<img src="{{ asset('public/img/banner-bio-tec.png') }}" />
</div>
<div id="search">
	<div style="width:900px; margin:auto;margin-top: 5px;">

		<form id="searchForm" name="searchForm" onsubmit="submitSearch()">
						<input type="hidden" name="taxon">
						<table style="margin: auto;">
							<tbody>
								<tr>
									<td>
										<select name="searchMenu" id="searchMenu" class="selectMenu" style="vertical-align: middle;">
											<option value="taxonomy" selected="">Taxonomy</option>
											<option value="records">Public Data</option>
											<option value="bins">BINs</option>
										</select>
									</td>
									<td>
										<div id="search-control-container">
											<input type="text" style="width:620px;height: 30px;border: 0;font-size: 15px;padding-left: 10px;" />
											<input type="submit" value="Tìm kiếm" style="  height: 30px;border: 0;float: right;background-color: F07C0B;color: #fff;font-size: 15px;" />
										</div>	
									</td>
								</tr>
							</tbody>
						</table>

		  </form>
	  </div>
</div>
<div class="box">
	<br/><br/>
			  <table border="0" align="center" cellpadding="2" cellspacing="2">
			    <tbody><tr>
				    <td width="130"><span class="roundBox purple"><a href="/index.php/Public_BINSearch?searchtype=records"><img src="{{ asset('public/img/publicDataPortal_icon.png') }}"></a></span></td>
				    <td width="400" valign="top" style=""><h3 style="font-size: 20px!important;">Public Data Portal:</h3>A data retrieval interface that allows for searching over 1.7M public records in BOLD using multiple search criteria including, but not limited to, geography, taxonomy, and depository.</td>
				    <td width="20">&nbsp;</td>
				    <td width="130"><span class="roundBox purple"><a href="/index.php/Public_BarcodeIndexNumber_Home"><img src="{{ asset('public/img/barcodeIndexNumbers_icon.png') }}" alt=""></a></span></td>
				    <td width="400" valign="top" style="font-size: 15px!important;"><h3 style="font-size: 20px!important;">Barcode Index Numbers:</h3>
			        A searchable database of Barcode Index Numbers (BINs), sequence clusters that closely approximate species. </td>
			      </tr>
				  <tr>
				    <td><span class="roundBox purple"><a href="/edu"><img src="{{ asset('public/img/studentDataPortal_icon.png') }}" alt=""></a></span></td>
				    <td valign="top" style="font-size: 15px!important;"><h3 style="font-size: 20px!important;">DNA Barcode Education Portal:</h3>
				    A custom platform for educators and students to explore barcode data and contribute  novel barcodes to the BOLD database.</td>
				    <td>&nbsp;</td>
				    <td><span class="roundBox purple"><a href="/index.php/MAS_Management_UserConsole"><img src="{{ asset('public/img/workbench_icon.png') }}" alt=""></a></span></td>
				    <td valign="top" style="font-size: 15px!important;"><h3 style="font-size: 20px!important;">Workbench:</h3>An integrated data collection and analysis environment that securely supports the assembly and validation of DNA barcodes and ancillary sequences.</td>
			      </tr>
			  </tbody></table>
			  <hr style="border: none; height: 1px; color: #DDD; background: #DDD;"><br>
              <h2 style="font-size: 15px!important;text-align:center">The Barcode of Life Data Systems  is designed to support the generation and application of DNA barcode data.  The platform consists of four main modules: a data portal, a database of barcode clusters, an educational portal, and a data collection workbench.</h2>
              <br>
              <br>
			  <div id="stats" style="background:#333;color: #eee;padding: 40px;padding-top: 14px;border-radius: 10px;">
				<table border="0" align="center" cellpadding="2" cellspacing="2">
				<tbody><tr>
				<td colspan="2"><h3>Sequence statistics</h3></td>
				<td width="50">&nbsp;</td>
				<td colspan="2"><h3>Species coverage (formally described)</h3></td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td width="100">&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td width="100">&nbsp;</td>
				</tr>
				<tr>
				<td width="300">Barcode clusters for animals (BINs)</td>
				<td>411,819</td>
				<td width="30">&nbsp;</td>
				<td width="280">Animals</td>
				<td><animalspeciesdataforlivestats>160,471<animalspeciesdataforlivestats></animalspeciesdataforlivestats></animalspeciesdataforlivestats></td>
				</tr>
				<tr>
				<td>All Sequences</td>
				<td>4,833,873</td>
				<td>&nbsp;</td>
				<td>Plants</td>
				<td><plantspeciesdataforlivestats>62,404<plantspeciesdataforlivestats></plantspeciesdataforlivestats></plantspeciesdataforlivestats></td>
				</tr>
				<tr>
				<td>Barcode Sequences</td>
				<td><totalbarcodesequencesforlivestats>4,223,010<totalbarcodesequencesforlivestats></totalbarcodesequencesforlivestats></totalbarcodesequencesforlivestats></td>
				<td>&nbsp;</td>
				<td>Fungi &amp; Other Life</td>
				<td><fungispeciesdataforlivestats>20,053<fungispeciesdataforlivestats></fungispeciesdataforlivestats></fungispeciesdataforlivestats></td>
				</tr>
				</tbody></table>
			  </div>


				<br><br><br>
			 

			</div>
@endsection