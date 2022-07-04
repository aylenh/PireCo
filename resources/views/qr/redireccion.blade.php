
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
		location.replace("https://play.google.com/store/apps/details?id=com.whatsapp&hl=es_CO&gl=US");
	}

	if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
		location.replace("https://apps.apple.com/es/app/whatsapp-messenger/id310633997");
	}
</script>
{{-- redireccionamiento app  --}}