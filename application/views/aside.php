<?
// 1 se le pasa 1 al metodo para los banners del header 
// 2 para los banners del aside1 ó laterales
// 3 para los banners del aside2 ó lateral extra
// 4 para los banners del aside3 ó lateral extra
$banner1=$this->propiedades_model->get_banner(2);
$banner2=$this->propiedades_model->get_banner(3);
$banner3=$this->propiedades_model->get_banner(4);
?>
<ul class="bannerAside">
	<li><a target="_blank" title="<? echo $banner1->titulo ?>" href="<? if(!empty($banner1->url)){echo $banne1->url;}else{ echo "javascript:void(0);"; } ?>"><img src="<? echo base_url().$banner1->path_banner ?>" /></a></li>
	<li><a target="_blank" title="<? echo $banner2->titulo ?>" href="<? if(!empty($banner2->url)){echo $banner2->url;}else{ echo "javascript:void(0);"; } ?>"><img src="<? echo base_url().$banner2->path_banner ?>" /></a></li>
	<li><a target="_blank" title="<? echo $banner3->titulo ?>" href="<? if(!empty($banner3->url)){echo $banner3->url;}else{ echo "javascript:void(0);"; } ?>"><img src="<? echo base_url().$banner3->path_banner ?>" /></a></li>
</ul>