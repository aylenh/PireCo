
<script language=javascript>
// if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
//    location.replace("https://goa-ti.com/");
// }
// if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
//    location.replace("https://goa-ti.com/");
// }

var userAgent = navigator.userAgent || navigator.vendor || window.opera;
	// if (/windows phone/i.test(userAgent)) {
	// 	// location.replace("https://goa-ti.com/");
    //     alert('no hay');
 	// }

	if (/android/i.test(userAgent)) {
		location.replace("https://play.google.com/store/apps/details?id=com.appPirenco");
	}

	if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
		location.replace("https://apps.apple.com/ar/app/pirenco/id1617291739");
	}
</script>
{{-- redireccionamiento app  --}}