<?php 

$request_server = json_decode(json_encode(file_get_contents('php://input')),true);
$request_server_diterima = json_decode($request_server,true);
$pesan = strtolower($request_server_diterima['query']['message']);
$pesan2 = strtolower($request_server_diterima['query']['sender']);
$cekgrup = strtolower($request_server_diterima['query']['isGroup']);

if ($cekgrup == false) 
{
	//jika ada yang chat babeh 
	// maka dia akan membalas Hay
	if ($pesan == "halo kak, tahu baksonya masih ada?")
	{
		echo '{"replies":[{"message":"mohon maaf, hari ini kami tutup"}]}';
	}

	if ($pesan == "Menu")
	{
		echo '{"replies":[{"message":"
			daftar menu Tahu Bakso Bot
			1. Stock 
				(mengecek ketersediaan stock Tahu Bakso Pahlawan)
			2. Harga
				(mengecek harga Tahu Bakso Pahlawan)
			"}]}';
	}

	//ini untuk melakukan respon 
	//ketika ada yang chat infocorona

	if ($pesan == "infocorona")
	{
		$url = "https://api.kawalcorona.com";
		$konten = file_get_contents($url);
		$data = json_decode($konten,true);

		$pesan = "";
		foreach ($data as $key) 
		{
			$negaracari = strtolower($key['attributes']['Country_Region']);
			if ($negaracari == "indonesia")
			{
				$negara = "🌎 ".$key['attributes']['Country_Region']."\\n";
				$konfirmasi = "🗒️ ".$key['attributes']['Confirmed']."\\n";
				$meninggal = "😢 " .$key['attributes']['Deaths']."\\n";
				$sembuh = "😇 ".$key['attributes']['Recovered']."\\n";
				$pesan .= $negara.$konfirmasi."\\n";
			}
		}
		echo '{"replies":[{"message":"'.$pesan.'"}]}';
	}

	


}




?>
