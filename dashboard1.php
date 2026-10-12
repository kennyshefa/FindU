 <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta charset="utf-8" />
<link rel="stylesheet" href="globals.css">
<link rel="stylesheet" href="styleguide.css">
<script src="https://cdn.tailwindcss.com"></script>
<script>
/** @type {import('tailwindcss').Config} */
tailwind.config = {
  
  corePlugins: {
    preflight: false,
  },
  theme: {
    extend: {
      
      colors:{
        "d-9d-9d-9": "var(--d-9d-9d-9)",
      "foundation-graydark": "var(--foundation-graydark)",
      "foundation-graydark-active": "var(--foundation-graydark-active)",
      "foundation-graydark-hover": "var(--foundation-graydark-hover)",
      "foundation-graydarker": "var(--foundation-graydarker)",
      "foundation-graylight": "var(--foundation-graylight)",
      "foundation-graylight-active": "var(--foundation-graylight-active)",
      "foundation-graylight-hover": "var(--foundation-graylight-hover)",
      "foundation-graynormal": "var(--foundation-graynormal)",
      "foundation-graynormal-active": "var(--foundation-graynormal-active)",
      "foundation-graynormal-hover": "var(--foundation-graynormal-hover)",
      "foundation-light-bluedark": "var(--foundation-light-bluedark)",
      "foundation-light-bluedark-active": "var(--foundation-light-bluedark-active)",
      "foundation-light-bluedark-hover": "var(--foundation-light-bluedark-hover)",
      "foundation-light-bluedarker": "var(--foundation-light-bluedarker)",
      "foundation-light-bluelight": "var(--foundation-light-bluelight)",
      "foundation-light-bluelight-active": "var(--foundation-light-bluelight-active)",
      "foundation-light-bluelight-hover": "var(--foundation-light-bluelight-hover)",
      "foundation-light-bluenormal": "var(--foundation-light-bluenormal)",
      "foundation-light-bluenormal-active": "var(--foundation-light-bluenormal-active)",
      "foundation-light-bluenormal-hover": "var(--foundation-light-bluenormal-hover)",
      "foundation-reddark": "var(--foundation-reddark)",
      "foundation-reddark-active": "var(--foundation-reddark-active)",
      "foundation-reddark-hover": "var(--foundation-reddark-hover)",
      "foundation-reddarker": "var(--foundation-reddarker)",
      "foundation-redlight": "var(--foundation-redlight)",
      "foundation-redlight-active": "var(--foundation-redlight-active)",
      "foundation-redlight-hover": "var(--foundation-redlight-hover)",
      "foundation-rednormal": "var(--foundation-rednormal)",
      "foundation-rednormal-active": "var(--foundation-rednormal-active)",
      "foundation-rednormal-hover": "var(--foundation-rednormal-hover)",
      "foundation-slatedark": "var(--foundation-slatedark)",
      "foundation-slatedark-active": "var(--foundation-slatedark-active)",
      "foundation-slatedark-hover": "var(--foundation-slatedark-hover)",
      "foundation-slatedarker": "var(--foundation-slatedarker)",
      "foundation-slatelight": "var(--foundation-slatelight)",
      "foundation-slatelight-active": "var(--foundation-slatelight-active)",
      "foundation-slatelight-hover": "var(--foundation-slatelight-hover)",
      "foundation-slatenormal": "var(--foundation-slatenormal)",
      "foundation-slatenormal-active": "var(--foundation-slatenormal-active)",
      "foundation-slatenormal-hover": "var(--foundation-slatenormal-hover)",
      "foundation-tealdark": "var(--foundation-tealdark)",
      "foundation-tealdark-active": "var(--foundation-tealdark-active)",
      "foundation-tealdark-hover": "var(--foundation-tealdark-hover)",
      "foundation-tealdarker": "var(--foundation-tealdarker)",
      "foundation-teallight": "var(--foundation-teallight)",
      "foundation-teallight-active": "var(--foundation-teallight-active)",
      "foundation-teallight-hover": "var(--foundation-teallight-hover)",
      "foundation-tealnormal": "var(--foundation-tealnormal)",
      "foundation-tealnormal-active": "var(--foundation-tealnormal-active)",
      "foundation-tealnormal-hover": "var(--foundation-tealnormal-hover)",
      "foundation-whitedark": "var(--foundation-whitedark)",
      "foundation-whitedark-active": "var(--foundation-whitedark-active)",
      "foundation-whitedark-hover": "var(--foundation-whitedark-hover)",
      "foundation-whitedarker": "var(--foundation-whitedarker)",
      "foundation-whitelight": "var(--foundation-whitelight)",
      "foundation-whitelight-active": "var(--foundation-whitelight-active)",
      "foundation-whitelight-hover": "var(--foundation-whitelight-hover)",
      "foundation-whitenormal": "var(--foundation-whitenormal)",
      "foundation-whitenormal-active": "var(--foundation-whitenormal-active)",
      "foundation-whitenormal-hover": "var(--foundation-whitenormal-hover)",
      "foundationamberdark": "var(--foundationamberdark)",
      "foundationamberdark-active": "var(--foundationamberdark-active)",
      "foundationamberdark-hover": "var(--foundationamberdark-hover)",
      "foundationamberdarker": "var(--foundationamberdarker)",
      "foundationamberlight": "var(--foundationamberlight)",
      "foundationamberlight-active": "var(--foundationamberlight-active)",
      "foundationamberlight-hover": "var(--foundationamberlight-hover)",
      "foundationambernormal": "var(--foundationambernormal)",
      "foundationambernormal-active": "var(--foundationambernormal-active)",
      "foundationambernormal-hover": "var(--foundationambernormal-hover)",
      "foundationprimary-bluedark": "var(--foundationprimary-bluedark)",
      "foundationprimary-bluedark-active": "var(--foundationprimary-bluedark-active)",
      "foundationprimary-bluedark-hover": "var(--foundationprimary-bluedark-hover)",
      "foundationprimary-bluedarker": "var(--foundationprimary-bluedarker)",
      "foundationprimary-bluelight": "var(--foundationprimary-bluelight)",
      "foundationprimary-bluelight-active": "var(--foundationprimary-bluelight-active)",
      "foundationprimary-bluelight-hover": "var(--foundationprimary-bluelight-hover)",
      "foundationprimary-bluenormal": "var(--foundationprimary-bluenormal)",
      "foundationprimary-bluenormal-active": "var(--foundationprimary-bluenormal-active)",
      "foundationprimary-bluenormal-hover": "var(--foundationprimary-bluenormal-hover)",
      
      },fontFamily:{
        "text": "var(--text-font-family)",
      
      },boxShadow:{
        "drop-shadow": "var(--drop-shadow)",
      
      },
      },
  },
  plugins: [],
}
        </script>
</head>
<body>
<div class="bg-white w-full min-w-[1440px] min-h-[1217px] flex flex-col" ><div class="ml-[26px] w-[1388px] h-[582.96px] mt-[22px] items-center gap-[54.53px] pt-[29.74px] pb-[49.57px] px-[56.18px] bg-foundationprimary-bluelight rounded-[11.57px] overflow-hidden flex relative flex-col" ><div class="flex w-[1150.06px] items-center justify-between px-[19.2px] py-[8.53px] relative flex-[0_0_auto] bg-white rounded-[10.67px]" ><img class="relative w-[155.72px] h-[61.86px] aspect-[2.52] object-cover" src="img/screenshot-2026-10-04-at-21-57-06-1.png" />
<div class="inline-flex items-center gap-[83.19px] relative flex-[0_0_auto]" ><div class="relative w-fit mt-[-1.07px] [font-family:'Inter-SemiBold',Helvetica] font-semibold text-foundationprimary-bluenormal text-[17.1px] tracking-[0] leading-[normal]" >Beranda</div>
<div class="relative w-fit mt-[-1.07px] [font-family:'Inter-SemiBold',Helvetica] font-semibold text-foundation-slatenormal text-[17.1px] tracking-[0] leading-[normal]" >Cari</div>
<div class="relative w-fit mt-[-1.07px] [font-family:'Inter-SemiBold',Helvetica] font-semibold text-foundation-slatenormal text-[17.1px] tracking-[0] leading-[normal]" >Upload</div>
<div class="relative w-fit mt-[-1.07px] [font-family:'Inter-SemiBold',Helvetica] font-semibold text-foundation-slatenormal text-[17.1px] tracking-[0] leading-[normal]" >Tentang Kami</div></div>
<div class="inline-flex justify-center gap-[10.67px] px-[25.6px] py-[14.93px] flex-[0_0_auto] bg-foundationprimary-bluenormal rounded-[14.93px] items-center relative" ><div class="relative w-fit mt-[-1.07px] [font-family:'Inter-Medium',Helvetica] font-medium text-foundationprimary-bluelight text-[17.1px] tracking-[0] leading-[normal]" >Login&nbsp;&nbsp;▾</div></div></div>
<div class="flex items-center gap-[66.1px] relative self-stretch w-full flex-[0_0_auto] overflow-hidden" ><div class="flex flex-col items-start gap-[26.44px] relative flex-1 grow" ><div class="items-start gap-[16.52px] self-stretch w-full flex-[0_0_auto] flex relative flex-col" ><div class="relative self-stretch mt-[-0.83px] [font-family:'Inter-Medium',Helvetica] font-medium text-foundationprimary-bluenormal text-[23.1px] tracking-[0] leading-[normal]" >Selamat datang di FindU</div>
<p class="relative self-stretch [font-family:'Inter-Bold',Helvetica] font-bold text-transparent text-[59.5px] tracking-[-1.19px] leading-[70.2px]" ><span class="text-[#101828] tracking-[-0.71px]" >Temukan Barangmu<br/></span>
<span class="text-[#2468ec] tracking-[-0.71px]" >Kembali</span></p>
<p class="relative w-[553.55px] [font-family:'Inter-Regular',Helvetica] font-normal text-[#667085] text-[18.2px] tracking-[0] leading-[27.3px]" >Bantu sesama dengan melaporkan barang hilang atau menemukan barang yang bukan milikmu.</p></div>
<div class="flex flex-col items-start gap-[13.22px] relative self-stretch w-full flex-[0_0_auto]" ><div class="flex w-[855.93px] h-[59.49px] items-center justify-between relative bg-white rounded-[14.87px] border-[0.83px] border-solid border-[#dae2ec]" ><div class="flex gap-[23.13px] px-[19.83px] py-0 flex-1 grow items-center relative" ><img class="relative w-[28.09px] h-[28.09px] aspect-[1]" src="img/boxicons-search-big.svg" />
<p class="relative w-fit [font-family:'Inter-Regular',Helvetica] font-normal text-[#a2a2a2] text-[16.5px] tracking-[0] leading-[normal]" >Cari nama barang, lokasi, atau kategori...</p></div>
<div class="inline-flex gap-[4.13px] px-[19.83px] py-[13.22px] flex-[0_0_auto] ml-[-1.53e-05px] bg-foundationprimary-bluenormal rounded-[13.22px] items-center relative" ><img class="relative w-[23.13px] h-[23.13px] aspect-[1]" src="img/boxicons-search-big-2.svg" />
<div class="relative w-fit [font-family:'Inter-Regular',Helvetica] font-normal text-white text-[16.5px] tracking-[0] leading-[normal]" >Cari</div></div></div>
<div class="inline-flex items-center gap-[8.26px] relative flex-[0_0_auto]" ><div class="relative w-[14.87px] h-[14.87px]" ><img class="absolute w-[87.78%] h-[96.11%] top-[3.89%] left-[12.22%]" src="img/vector.svg" /></div>
<p class="relative w-fit mt-[-0.83px] [font-family:'Inter-Regular',Helvetica] font-normal text-foundation-slatenormal text-[13.2px] tracking-[0] leading-[normal]" >Cari barang hilang &amp; ditemukan di sekitar UB</p></div></div></div>
<div class="flex flex-col w-[353.61px] items-start gap-[16.52px] p-[23.13px] relative bg-foundation-whitelight rounded-[11.57px] overflow-hidden" ><img class="relative self-stretch w-full h-[132.19px] object-cover" src="img/community-illustration.png" />
<div class="flex flex-col items-start gap-[8.26px] relative self-stretch w-full flex-[0_0_auto]" ><div class="inline-flex items-center gap-[8.26px] relative flex-[0_0_auto]" ><img class="relative w-[16.52px] h-[16.52px]" src="img/add-report.svg" />
<div class="relative w-fit mt-[-0.83px] [font-family:'Inter-Bold',Helvetica] font-bold text-[#101828] text-[19.8px] tracking-[0] leading-[normal]" >Punya kabar barang?</div></div>
<p class="relative self-stretch [font-family:'Inter-Regular',Helvetica] font-normal text-[#667085] text-sm tracking-[0] leading-[21.1px]" >Buat laporan agar barang lebih cepat kembali ke pemiliknya.</p></div></div></div></div>
<div class="flex w-[1390px] h-[478.12px] relative mt-[45.0px] flex-col items-start gap-[23.17px] px-[36.4px] py-0" ><div class="flex items-center justify-between relative self-stretch w-full flex-[0_0_auto]" ><div class="inline-flex flex-col items-start gap-[8.27px] relative flex-[0_0_auto]" ><div class="relative w-fit mt-[-0.83px] [font-family:'Inter-Bold',Helvetica] font-bold text-[#101828] text-[28.1px] tracking-[0] leading-[normal]" >Barang Terbaru</div>
<p class="relative w-fit [font-family:'Inter-Regular',Helvetica] font-normal text-[#667085] text-[14.9px] tracking-[0] leading-[normal]" >Mungkin barang yang kamu cari ada di sini.</p></div>
<div class="inline-flex items-center gap-[11.58px] relative flex-[0_0_auto]" ><div class="relative w-fit mt-[-0.24px] [font-family:'Inter-Bold',Helvetica] font-bold text-foundationprimary-bluenormal text-[18.2px] tracking-[0] leading-[normal]" >Lihat Semua</div>
<img class="relative w-[23.17px] h-[23.17px]" src="img/view-all-arrow.svg" /></div></div>
<div class="flex items-center justify-between relative self-stretch w-full flex-[0_0_auto]" ><div class="gap-[30.61px] flex-[0_0_auto] inline-flex items-center relative" ><div class="inline-flex h-[33.92px] justify-center gap-[8.27px] px-[19.86px] py-[8.27px] flex-[0_0_auto] bg-foundationprimary-bluenormal rounded-[14.89px] items-center relative" ><div class="relative w-fit mt-[-0.14px] [font-family:'Inter-Bold',Helvetica] font-bold text-white text-[13.2px] tracking-[0] leading-[normal]" >Semua</div></div>
<div class="inline-flex justify-center gap-[8.27px] px-[19.86px] py-[8.27px] flex-[0_0_auto] rounded-[14.89px] border-[0.83px] border-solid border-foundation-graynormal items-center relative" ><div class="relative w-fit [font-family:'Inter-Bold',Helvetica] font-bold text-foundation-graynormal text-[13.2px] tracking-[0] leading-[normal]" >Hilang</div></div>
<div class="inline-flex justify-center gap-[8.27px] px-[19.86px] py-[8.27px] flex-[0_0_auto] rounded-[14.89px] border-[0.83px] border-solid border-foundation-tealnormal items-center relative" ><div class="text-foundation-tealnormal relative w-fit [font-family:'Inter-Bold',Helvetica] font-bold text-[13.2px] tracking-[0] leading-[normal]" >Ditemukan</div></div></div>
<div class="flex w-[104.25px] items-center gap-[17.38px] px-[11.58px] py-[4.96px] relative bg-white rounded-[6.62px] border-[0.83px] border-solid border-foundation-graylight-active" ><div class="relative w-fit [font-family:'Inter-Bold',Helvetica] font-bold text-foundation-slatenormal text-[13.2px] tracking-[0] leading-[normal]" >Terbaru</div>
<img class="relative w-[19.86px] h-[19.86px] mr-[-7.98px] aspect-[1]" src="img/basil-caret-down-outline.svg" /></div></div>
<div class="flex items-start gap-[33.1px] relative self-stretch w-full flex-[0_0_auto]" ><div class="flex flex-col items-start gap-[14.89px] p-[16.55px] relative flex-1 grow bg-foundation-whitelight rounded-[6.62px] overflow-hidden shadow-[0px_3.31px_9.93px_#00000040]" ><img class="relative self-stretch w-full h-[163.82px] object-cover" src="img/image.png" />
<div class="inline-flex h-[33.1px] items-center justify-center gap-[8.27px] px-[19.86px] py-[11.58px] relative bg-foundation-teallight rounded-[14.89px]" ><div class="relative w-fit mt-[-3.86px] mb-[-2.21px] [font-family:'Inter-Bold',Helvetica] font-bold text-foundation-tealdark text-[13.2px] tracking-[0] leading-[normal]" >Ditemukan</div></div>
<div class="flex flex-col items-start gap-[10.76px] relative self-stretch w-full flex-[0_0_auto]" ><div class="relative self-stretch mt-[-0.83px] [font-family:'Inter-Bold',Helvetica] font-bold text-foundation-slatenormal text-[19.9px] tracking-[0] leading-[normal]" >Dompet</div>
<div class="inline-flex items-center gap-[11.58px] relative flex-[0_0_auto] overflow-hidden" ><div class="relative w-[10.59px] h-[13.24px]" ><img class="absolute top-0.5 left-0.5 w-1.5 h-1.5" src="img/pin-center-3.svg" />
<img class="absolute -top-px left-0 w-[11px] h-[15px]" src="img/pin-outline-4.svg" /></div>
<div class="relative w-fit mt-[-0.83px] [font-family:'Inter-Regular',Helvetica] font-normal text-foundation-slatenormal text-[13.2px] tracking-[0] leading-[normal]" >Perpus UB</div></div>
<div class="inline-flex items-center gap-[11.58px] relative flex-[0_0_auto] overflow-hidden" ><img class="relative w-[13.24px] h-[13.24px]" src="img/clock.svg" />
<div class="relative w-fit mt-[-0.83px] [font-family:'Inter-Regular',Helvetica] font-normal text-foundation-slatenormal text-[13.2px] tracking-[0] leading-[normal]" >4 hari yang lalu</div></div></div></div>
<div class="flex flex-col items-start gap-[14.89px] p-[16.55px] relative flex-1 grow bg-foundation-whitelight rounded-[6.62px] overflow-hidden shadow-[0px_3.31px_9.93px_#00000040]" ><img class="relative self-stretch w-full h-[163.82px] object-cover" src="img/item-photo-2.png" />
<div class="inline-flex h-[33.1px] items-center justify-center gap-[8.27px] px-[19.86px] py-[11.58px] relative bg-foundation-teallight rounded-[14.89px]" ><div class="relative w-fit mt-[-3.86px] mb-[-2.21px] [font-family:'Inter-Bold',Helvetica] font-bold text-foundation-tealdark text-[13.2px] tracking-[0] leading-[normal]" >Ditemukan</div></div>
<div class="flex flex-col items-start gap-[10.76px] relative self-stretch w-full flex-[0_0_auto]" ><div class="relative self-stretch mt-[-0.83px] [font-family:'Inter-Bold',Helvetica] font-bold text-foundation-slatenormal text-[19.9px] tracking-[0] leading-[normal]" >Kunci Motor</div>
<div class="inline-flex items-center gap-[11.58px] relative flex-[0_0_auto]" ><div class="relative w-[10.59px] h-[13.24px]" ><img class="absolute top-0.5 left-0.5 w-1.5 h-1.5" src="img/image.svg" />
<img class="absolute -top-px left-0 w-[11px] h-[15px]" src="img/pin-outline-2.svg" /></div>
<div class="relative w-fit mt-[-0.83px] [font-family:'Inter-Regular',Helvetica] font-normal text-foundation-slatenormal text-[13.2px] tracking-[0] leading-[normal]" >Parkiran FILKOM</div></div>
<div class="inline-flex items-center gap-[11.58px] relative flex-[0_0_auto] overflow-hidden" ><img class="relative w-[13.24px] h-[13.24px]" src="img/clock.svg" />
<div class="relative w-fit mt-[-0.83px] [font-family:'Inter-Regular',Helvetica] font-normal text-foundation-slatenormal text-[13.2px] tracking-[0] leading-[normal]" >2 jam yang lalu</div></div></div></div>
<div class="flex flex-col items-start gap-[14.89px] p-[16.55px] relative flex-1 grow bg-foundation-whitelight rounded-[6.62px] overflow-hidden shadow-[0px_3.31px_9.93px_#00000040]" ><img class="relative self-stretch w-full h-[163.82px] object-cover" src="img/item-photo.png" />
<div class="h-[33.1px] justify-center gap-[8.27px] px-[19.86px] py-[11.58px] bg-foundationamberlight rounded-[14.89px] inline-flex items-center relative" ><div class="mt-[-3.86px] mb-[-2.21px] text-foundationamberdark relative w-fit [font-family:'Inter-Bold',Helvetica] font-bold text-[13.2px] tracking-[0] leading-[normal]" >Hilang</div></div>
<div class="flex flex-col items-start gap-[10.76px] relative self-stretch w-full flex-[0_0_auto]" ><div class="relative self-stretch mt-[-0.83px] [font-family:'Inter-Bold',Helvetica] font-bold text-foundation-slatenormal text-[19.9px] tracking-[0] leading-[normal]" >Tumbler Biru</div>
<div class="inline-flex items-center gap-[11.58px] relative flex-[0_0_auto]" ><div class="relative w-[10.59px] h-[13.24px]" ><img class="absolute top-0.5 left-0.5 w-1.5 h-1.5" src="img/pin-center-2.svg" />
<img class="absolute -top-px left-0 w-[11px] h-[15px]" src="img/pin-outline.svg" /></div>
<div class="relative w-fit mt-[-0.83px] [font-family:'Inter-Regular',Helvetica] font-normal text-foundation-slatenormal text-[13.2px] tracking-[0] leading-[normal]" >Gedung FISIP</div></div>
<div class="inline-flex items-center gap-[11.58px] relative flex-[0_0_auto] overflow-hidden" ><img class="relative w-[13.24px] h-[13.24px]" src="img/clock.svg" />
<div class="relative w-fit mt-[-0.83px] [font-family:'Inter-Regular',Helvetica] font-normal text-foundation-slatenormal text-[13.2px] tracking-[0] leading-[normal]" >5 jam yang lalu</div></div></div></div>
<div class="flex flex-col items-start gap-[14.89px] p-[16.55px] relative flex-1 grow bg-foundation-whitelight rounded-[6.62px] overflow-hidden shadow-[0px_3.31px_9.93px_#00000040]" ><img class="relative self-stretch w-full h-[163.82px] object-cover" src="img/item-photo-3.png" />
<div class="inline-flex h-[33.1px] items-center justify-center gap-[8.27px] px-[19.86px] py-[11.58px] relative bg-foundation-teallight rounded-[14.89px]" ><div class="relative w-fit mt-[-3.86px] mb-[-2.21px] [font-family:'Inter-Bold',Helvetica] font-bold text-foundation-tealdark text-[13.2px] tracking-[0] leading-[normal]" >Ditemukan</div></div>
<div class="flex flex-col items-start gap-[10.76px] relative self-stretch w-full flex-[0_0_auto]" ><div class="relative self-stretch mt-[-0.83px] [font-family:'Inter-Bold',Helvetica] font-bold text-foundation-slatenormal text-[19.9px] tracking-[0] leading-[normal]" >Kacamata</div>
<div class="inline-flex items-center gap-[11.58px] relative flex-[0_0_auto]" ><div class="relative w-[10.59px] h-[13.24px]" ><img class="absolute top-0.5 left-0.5 w-1.5 h-1.5" src="img/pin-center.svg" />
<img class="absolute -top-px left-0 w-[11px] h-[15px]" src="img/pin-outline-3.svg" /></div>
<div class="relative w-fit mt-[-0.83px] [font-family:'Inter-Regular',Helvetica] font-normal text-foundation-slatenormal text-[13.2px] tracking-[0] leading-[normal]" >Kantin FEB</div></div>
<div class="inline-flex items-center gap-[11.58px] relative flex-[0_0_auto] overflow-hidden" ><img class="relative w-[13.24px] h-[13.24px]" src="img/clock.svg" />
<div class="relative w-fit mt-[-0.83px] [font-family:'Inter-Regular',Helvetica] font-normal text-foundation-slatenormal text-[13.2px] tracking-[0] leading-[normal]" >1 hari yang lalu</div></div></div></div></div></div>
<div class="flex w-[1440px] h-[42.71px] relative mt-[29.9px] items-start justify-between pt-[18.86px] pb-[6.86px] px-[37.71px] border-t-[0.86px] [border-top-style:solid] border-slate-200" ><p class="relative w-fit mt-[-0.86px] [font-family:'Inter-Regular',Helvetica] font-normal text-foundation-slatenormal text-[13.7px] tracking-[0] leading-[normal]" >FindU — saling bantu, saling menemukan di sekitar UB.</p>
<div class="relative w-fit mt-[-0.86px] [font-family:'Inter-SemiBold',Helvetica] font-semibold text-foundationprimary-bluenormal text-[13.7px] tracking-[0] leading-[normal]" >Butuh bantuan?</div></div></div>
</body>
</html>