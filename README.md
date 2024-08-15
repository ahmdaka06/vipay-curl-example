# Vipayment Class

Vipayment adalah class PHP yang dirancang untuk memfasilitasi integrasi dengan API VIP Reseller. Dengan class ini, Anda dapat mengelola berbagai transaksi pembayaran, seperti mendapatkan informasi profil, melakukan pemesanan layanan prabayar, memeriksa status transaksi, dan mendapatkan daftar layanan prabayar yang tersedia.

## Fitur

- **Profile**: Mendapatkan informasi profil pengguna dari API.
- **Order Prepaid**: Melakukan pemesanan untuk layanan prabayar (misalnya, pulsa atau token listrik).
- **Status Prepaid**: Mengecek status dari transaksi prabayar.
- **Service Prepaid**: Mendapatkan daftar layanan prabayar yang tersedia.

## Persyaratan

- PHP 7.4 atau lebih baru
- Ekstensi PHP cURL diaktifkan

## Instalasi

Tambahkan file `Vipayment.php` ke dalam proyek PHP Anda. Pastikan untuk menyertakan file tersebut menggunakan `require_once` atau `include_once` di file PHP Anda.

## Penggunaan

### 1. Inisialisasi

Buat instance dari class `Vipayment` dengan memberikan `API ID` dan `API Key` yang Anda peroleh dari VIP Reseller.

```php
require_once 'Vipayment.php';

$vipayment = new Vipayment('API_ID', 'API_KEY');

$profile = $vipayment->profile();
if ($profile['status']) {
    print_r($profile['data']);
} else {
    echo $profile['message'];
}

$order = $vipayment->order_prepaid('PULSA5', '081234567890');
if ($order['status']) {
    print_r($order['data']);
} else {
    echo $order['message'];
}

$status = $vipayment->status_prepaid('1234567890', 1);
if ($status['status']) {
    print_r($status['data']);
} else {
    echo $status['message'];
}

$services = $vipayment->service_prepaid('type', 'pulsa-reguler');
if ($services['status']) {
    print_r($services['data']);
} else {
    echo $services['message'];
}
