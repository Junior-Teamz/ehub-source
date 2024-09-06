@extends('landing.layouts.app')

@section('extra-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
<style>
  .tabcontent {
    display: none;
  }
</style>
@endsection

@section('content')
<div class="flex">
  <div class="w-4/12 flex-grow bg-[#F8FAFC] pr-12 -ml-[76px]">
    <div class="py-10 px-[76px]">
      <div class="flex items-center gap-2 mb-5">
        <img class="w-24" src="{{ asset('images/logo-kemenkop.png') }}" alt="Logo Kemenkop" />
        <img class="w-32" src="{{ asset('images/logo-ehub-new.png') }}" alt="Logo EnterpreneurHub" />
        <h1>hellow orld</h1>
      </div>
      <p class="text-lg text-gray-600">Lengkapi data anda untuk bisa mengikuti program-program dari EntrepreneurHub Gratis!</p>
      <div class="flex flex-col py-16 gap-7">
        <a type="button" onclick="activateTab(event, 'form-step-1')" class="flex flex-row gap-3 cursor-pointer">
          <ion-icon name="checkmark-circle-outline" class="tab-sign text-[#16A34A] text-3xl font-bold"></ion-icon>
          <div class="flex flex-col">
            <div class="font-bold text-gray-800">Data Diri</div>
            <span class="text-gray-500">Lengkapi data diri anda</span>
          </div>
        </a>
        <a type="button" onclick="activateTab(event, 'form-step-2')" class="flex flex-row gap-3 cursor-pointer">
          <ion-icon name="checkmark-circle-outline" class="tab-sign text-[#4B5563] text-3xl font-bold"></ion-icon>
          <div class="flex flex-col">
            <div class="font-bold text-gray-800">Data Usaha</div>
            <span class="text-gray-500">Lengkapi data usaha anda</span>
          </div>
        </a>
        <a type="button" onclick="activateTab(event, 'form-step-3')"  class="flex flex-row gap-3 cursor-pointer">
          <ion-icon name="checkmark-circle-outline" class="tab-sign text-[#4B5563] text-3xl font-bold"></ion-icon>
          <div class="flex flex-col">
            <div class="font-bold text-gray-800">Data Marketing</div>
            <span class="text-gray-500">Lengkapi data marketing anda</span>
          </div>
        </a>
      </div>
    </div>
  </div>
  <div class="w-6/12 flex-grow">
    <div class="flex justify-center py-10">
      <div class="flex flex-col w-full px-40">
        <div class="flex flex-col mb-6">
          <div id="form-title" class="font-bold text-gray-800">Data Diri</div>
          <span id="form-subtitle" class="text-gray-500">Lengkapi data diri anda</span>
        </div>
        <form id="form-update-data" name="formUpdateData" action="{{ route('workshops.update.data') }}" method="POST">
          @csrf
          <section id="form-step-1" class="tabcontent" style="display: block;">
            <div class="mb-5">
              <div class="flex flex-row items-center gap-1 mb-2">
                <label class="block text-[#4B5563] text-xs font-semibold" id="label-fullname" for="fullname">Nama</label>
                <span class="text-secondary">*</span>
              </div>
              <input id="fullname" class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none" name="name" type="text" placeholder="Masukkan nama" />
              <span id="error-fullname" class="text-red-500 text-sm mt-1"></span>
            </div>
            <div class="mb-5">
              <div class="flex flex-row items-center gap-1 mb-2">
                <label class="block text-[#4B5563] text-xs font-semibold" id="label-email" for="email">Email</label>
                <span class="text-secondary">*</span>
              </div>
              <input id="email" class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none" name="email" type="email" placeholder="contoh: budi@gmail.com" />
              <span id="error-email" class="text-red-500 text-sm mt-1"></span>
            </div>
            <div class="mb-5">
              <div class="flex flex-row items-center gap-1 mb-2">
                <label class="block text-[#4B5563] text-xs font-semibold" id="label-phone" for="phone">No. HP/WhatsApp</label>
                <span class="text-secondary">*</span>
              </div>
              <input id="phone" class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none" name="phone" type="text" placeholder="contoh: 08151563xxxx" />
              <span id="error-phone" class="text-red-500 text-sm mt-1"></span>
            </div>
            <div class="mb-5">
              <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="born-date">Tanggal Lahir</label>
              <div class="relative">
                <input id="born-date" class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none" name="born_date" type="text" placeholder="26 April 1990" />
                <ion-icon name="calendar-clear-outline" class="absolute right-3 top-2.5 text-xl"></ion-icon>
              </div>
            </div>
            <div class="mb-5">
              <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="born-place">Tempat Lahir</label>
              <input id="born-place" class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none" name="born_place" type="text" placeholder="contoh: Jakarta" />
            </div>
            <div class="mb-5">
              <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="gender">Jenis Kelamin</label>
              <div class="flex flex-row gap-4 ml-2">
                <div class="flex items-center mb-4">
                  <input id="country-option-1" type="radio" name="gender" value="male" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" aria-labelledby="country-option-1" aria-describedby="country-option-1" checked="">
                  <label for="country-option-1" class="text-[#4C4E64DE] ml-2 block">Laki-Laki</label>
                </div>
                <div class="flex items-center mb-4">
                  <input id="country-option-2" type="radio" name="gender" value="female" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" aria-labelledby="country-option-2" aria-describedby="country-option-2">
                  <label for="country-option-2" class="text-[#4C4E64DE] ml-2 block">Perempuan</label>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-block btn-lg btn-secondary mt-16" onclick="activateTab(event, 'form-step-2')">Berikutnya</button>
          </section>
          <section id="form-step-2" class="tabcontent">
            <div class="mb-5">
              <div class="flex flex-row items-center gap-1 mb-2">
                <label class="block text-[#4B5563] text-xs font-semibold" id="label-business-name" for="business-name">Nama Usaha</label>
                <span class="text-secondary">*</span>
              </div>
              <input id="business-name" class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none" name="business_name" type="text" placeholder="Nama usaha" />
              <span class="text-red-500 mt-1 text-sm" id="error-business-name"></span>
            </div>
            <div class="mb-5">
              <div class="flex flex-row items-center gap-1 mb-2">
                <label class="block text-[#4B5563] text-xs font-semibold" id="label-business-address" for="business-address">Alamat Usaha</label>
                <span class="text-secondary">*</span>
              </div>
              <textarea id="business-address" class="resize text-sm p-2 w-full border border-[#E5E7EB] rounded-md" rows="5" placeholder="Masukkan alamat usaha"></textarea>
              <span class="text-red-500 mt-1 text-sm" id="error-business-address"></span>
            </div>
            <div class="mb-5">
              <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="business-type">Jenis Usaha</label>
              <div class="relative">
                <select class="block form-input appearance-none w-full border border-[#E5E7EB] text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none">
                  <option>:: Pilih jenis usaha</option>
                  <option>Produsen/Pemilik Merek</option>
                  <option>UKM & Koperasi</option>
                  <option>Agen</option>
                  <option>Distributor</option>
                  <option>Petani & Nelayan</option>
                  <option>Pedagang Eceran</option>
                  <option>Eksportir/Importir</option>
                </select>
              </div>
            </div>
            <div class="mb-5">
              <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="nib">Nomor NIB</label>
              <input id="nib" class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none" name="nib" type="text" placeholder="JDK000231xxxx" />
            </div>
            <div class="mb-5">
              <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="business-age">Umur Usaha</label>
              <input id="business-age" class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none" name="phone" type="text" placeholder="Umur Usaha" />
            </div>
            <div class="flex flex-row gap-x-5 mt-16">
              <button type="button" class="btn btn-block btn-lg btn-outline-secondary" onclick="activateTab(event, 'form-step-1')">Sebelumnya</button>
              <button type="button" class="btn btn-block btn-lg btn-secondary" onclick="activateTab(event, 'form-step-3')">Berikutnya</button>
            </div>
          </section>
          <section id="form-step-3" class="tabcontent">
            <div class="mb-5">
              <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="born-place">Akun IG Usaha</label>
              <input id="born-place" class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none" name="ig_account" type="text" placeholder="Akun Instagram" />
            </div>
            <div class="mb-5">
              <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="born-place">Akun FB Usaha</label>
              <input id="born-place" class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none" name="fb_account" type="text" placeholder="Akun Facebook" />
            </div>
            <div class="mb-5">
              <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="born-place">Akun TikTok Usaha</label>
              <input id="born-place" class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none" name="tiktok_account" type="text" placeholder="Akun Tiktok" />
            </div>
            <div class="mb-5">
              <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="born-place">Komunitas Usaha</label>
              <input id="born-place" class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none" name="tiktok_account" type="text" placeholder="Nama Komunitas Usaha" />
            </div>
            <div class="mb-5">
              <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="gender">Platform Usaha</label>
              <div class="flex flex-col gap-4 ml-2">
                <div class="flex flex-row items-center">
                  <input type="checkbox" id="shopee" class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer">
                  <label for="shopee" class="ml-4 text-[#374151] cursor-pointer">Shopee</label>
                </div>
                <div class="flex flex-row items-center">
                  <input type="checkbox" id="tokopedia" class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer">
                  <label for="tokopedia" class="ml-4 text-[#374151] cursor-pointer">Tokopedia</label>
                </div>
                <div class="flex flex-row items-center">
                  <input type="checkbox" id="blibli" class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer">
                  <label for="blibli" class="ml-4 text-[#374151] cursor-pointer">Blibli</label>
                </div>
                <div class="flex flex-row items-center">
                  <input type="checkbox" id="lazada" class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer">
                  <label for="lazada" class="ml-4 text-[#374151] cursor-pointer">Lazada</label>
                </div>
                <div class="flex flex-row items-center">
                  <input type="checkbox" id="bukalapak" class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer">
                  <label for="bukalapak" class="ml-4 text-[#374151] cursor-pointer">Bukalapak</label>
                </div>
              </div>
            </div>
            <div class="flex flex-row gap-x-5 mt-16">
              <button type="button" class="btn btn-block btn-lg btn-outline-secondary" onclick="activateTab(event, 'form-step-2')">Sebelumnya</button>
              <button type="submit" class="btn btn-block btn-lg btn-secondary">Kirim</button>
            </div>
          </section>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('extra-js')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  flatpickr("#born-date", {
    altInput: true,
    altFormat: "d F Y",
    dateFormat: "Y-m-d"
  });

  function activateTab(evt, formStep) {
    var i, tabcontent, tablinks;
    var validation = inputValidation(formStep);
    if (validation) {
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(formStep).style.display = "block";
      evt.currentTarget.className += " active";

      toggleTabSign(formStep);
    } else {
      return false;
    }
  }

  function toggleTabSign(activeTab) {
    const formTitle = document.getElementById("form-title");
    const formSubtitle = document.getElementById("form-subtitle");
    const tabSign = document.getElementsByClassName("tab-sign");
    const currentTab = +activeTab.slice(-1) - 1;
    if (currentTab === 0) {
      formTitle.innerHTML = 'Data Diri';
      formSubtitle.innerHTML = 'Lengkapi data diri anda';
    } else if (currentTab === 1) {
      formTitle.innerHTML = 'Data Usaha';
      formSubtitle.innerHTML = 'Lengkapi data usaha anda';
    } else if (currentTab === 2) {
      formTitle.innerHTML = 'Data Marketing';
      formSubtitle.innerHTML = 'Lengkapi data marketing anda';
    }
    for (let i = 1; i <= 3; i++) {
      var inputs = document.querySelectorAll('#form-step-' + i +' input, ' + '#form-step-' + i +' textarea, ' + '#form-step-' + i +' select');
      var flag = true;
      for (let j = 0; j < inputs.length; j++) {
        if (inputs[j].value == '') {
          flag = false;
        }
      }
      if ((i - 1) == currentTab) {
        tabSign[currentTab].classList.remove("text-[#4B5563]");
        tabSign[currentTab].classList.remove("text-[#16A34A]/[0.5]");
        tabSign[currentTab].classList.add("text-[#16A34A]");
      } else {
        if (flag) {
          tabSign[(i - 1)].classList.remove("text-[#4B5563]");
          tabSign[(i - 1)].classList.remove("text-[#16A34A]");
          tabSign[(i - 1)].classList.add("text-[#16A34A]/[0.5]");
        } else {
          tabSign[(i - 1)].classList.remove("text-[#16A34A]");
          tabSign[(i - 1)].classList.remove("text-[#16A34A]/[0.5]");
          tabSign[(i - 1)].classList.add("text-[#4B5563]");
        }
      }
    }
  }

  document.querySelector("#form-update-data").addEventListener("submit", function(e) {
    var fields = ['fullname', 'email', 'phone', 'business-name', 'business-address'];
    var flag = true;
    for (let i = 0; i < fields.length; i++) {
      let elInput = document.getElementById(fields[i]);
      if (elInput.value == '') {
        flag = false;
        elInput.classList.remove('border-[#E5E7EB]');
        elInput.classList.add('border-red-500');
        elError.innerHTML = elLabel.textContent + ' wajib diisi!';
      }
    }
    if (flag) {
      Swal.fire({
        title: 'Pendaftaran Berhasil!',
        text: 'Anda telah terdaftar di program Workshop Peningkatan Kapasitas PLUT KUMKM, tunggu konfirmasi lebih lanjut',
        icon: 'success',
        confirmButtonText: 'OK'
      })
    } else {
      Swal.fire({
        title: 'Error!',
        text: 'Ada field yang belum anda isi! Silakan cek kembali.',
        icon: 'error',
        confirmButtonText: 'OK'
      })
    }
  });

  function inputValidation(formStep) {
    var currentTab = +formStep.slice(-1) - 1;
    var flag = true;
    if (currentTab == 1) {
      var fields = ['fullname', 'email', 'phone'];
      for (let i = 0; i < fields.length; i++) {
        let elInput = document.getElementById(fields[i]);
        let elLabel = document.getElementById('label-'+fields[i]);
        let elError = document.getElementById('error-'+fields[i]);
        elInput.classList.remove('border-red-500');
        elInput.classList.add('border-[#E5E7EB]');
        elError.innerHTML = '';
        if (elInput.value == '') {
          flag = false;
          elInput.classList.remove('border-[#E5E7EB]');
          elInput.classList.add('border-red-500');
          elError.innerHTML = elLabel.textContent + ' wajib diisi!';
        }
        if (elInput.id == 'email' && elInput.value != '') {
          var atposition = elInput.value.indexOf("@");
          var dotposition = elInput.value.lastIndexOf(".");
          if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= elInput.value.length) {
            flag = false;
            elInput.classList.remove('border-[#E5E7EB]');
            elInput.classList.add('border-red-500');
            elError.innerHTML = elLabel.textContent + ' harus diisi dengan email yang valid!';
          }
        }
        if (elInput.id == 'phone' && elInput.value != '') {
          if (isNaN(elInput.value)) {
            flag = false;
            elInput.classList.remove('border-[#E5E7EB]');
            elInput.classList.add('border-red-500');
            elError.innerHTML = elLabel.textContent + ' harus diisi dengan nomor yang valid!';
          }
        }
      }
    } else if (currentTab == 2) {
      var fields = ['business-name', 'business-address'];
      for (let i = 0; i < fields.length; i++) {
        let elInput = document.getElementById(fields[i]);
        let elLabel = document.getElementById('label-'+fields[i]);
        let elError = document.getElementById('error-'+fields[i]);
        elInput.classList.remove('border-red-500');
        elInput.classList.add('border-[#E5E7EB]');
        elError.innerHTML = '';
        if (elInput.value == '') {
          flag = false;
          elInput.classList.remove('border-[#E5E7EB]');
          elInput.classList.add('border-red-500');
          elError.innerHTML = elLabel.textContent + ' wajib diisi!';
        }
      }
    }
    return flag;
  }
</script>
@endsection
