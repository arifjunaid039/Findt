<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackToYou | Report Item</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/reportitem.css') }}">
    <style>
        .form-group.field-error input,
        .form-group.field-error select,
        .form-group.field-error textarea {
            border: 1px solid #b3261e !important;
            box-shadow: 0 0 0 2px rgba(179, 38, 30, 0.15);
        }
        .field-error-msg {
            display: block;
            color: #b3261e;
            font-size: 0.82rem;
            margin-top: 4px;
        }
        .upload-box.field-error {
            border: 1px solid #b3261e !important;
        }
        .type-select-group.field-error .type-card-inner {
            outline: 1px solid #b3261e;
        }
        .alert-danger.js-alert {
            display: none;
        }


@media (max-width:768px){
    .report-form{
        padding-left:16px;
        padding-right:16px;
    }

    .form-row{
        flex-direction:column;
    }

    .form-row .form-group{
        width:100%;
    }

    .type-select-group{
        flex-direction:column;
    }

    .type-card{
        width:100%;
    }

    .cr-dropdown-menu{
        max-height:260px;
        overflow-y:auto;
    }

    .upload-box{
        height:auto;
        min-height:160px;
    }
}

@media (max-width:480px){
    .form-header h2{
        font-size:1.3rem;
    }

    .form-header p{
        font-size:.88rem;
    }

    input[type="text"],
    input[type="date"],
    select,
    textarea{
        font-size:16px;
    }

    .cr-dropdown-toggle{
        width:100%;
    }

    button[type="submit"]{
        width:100%;
        justify-content:center;
    }
}
    </style>
</head>
<body>

    @include('nav')

    <form action="/items/store" method="POST" enctype="multipart/form-data" class="report-form" id="reportForm" novalidate>
        @csrf

        <div class="form-header">
            <div class="form-icon"><i class="fa-solid fa-magnifying-glass-location"></i></div>
            <h2>Report Lost / Found Item</h2>
            <p>Help reunite owners with their belongings by providing accurate information.</p>
        </div>

        @if (session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- JS-driven summary alert (hidden by default) -->
        <div class="alert-danger js-alert" id="jsAlert">
            <i class="fa-solid fa-circle-exclamation"></i>
            <ul id="jsAlertList"></ul>
        </div>

        <!-- Type Selector -->
        <div class="type-select-group" id="typeSelectGroup">
            <label class="type-card">
                <input type="radio" name="item_type" value="lost" required {{ old('item_type') == 'lost' ? 'checked' : '' }}>
                <div class="type-card-inner lost-card">
                    <i class="fa-solid fa-circle-question"></i>
                    <span>Lost Item</span>
                </div>
            </label>
            <label class="type-card">
                <input type="radio" name="item_type" value="found" required {{ old('item_type') == 'found' ? 'checked' : '' }}>
                <div class="type-card-inner found-card">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                    <span>Found Item</span>
                </div>
            </label>
        </div>
        <span class="field-error-msg" id="err-item_type" style="display:none;">Please select whether the item is Lost or Found.</span>

        <!-- Category + Date -->
        <div class="form-row">
            <div class="form-group" id="group-category_id">
                <label><i class="fa-solid fa-tags"></i> Category <span class="required">*</span></label>

                {{-- Category — same styled dropdown component used for Location / Community below --}}
                <div class="cr-dropdown" id="categoryDropdown">

                    <input type="hidden" name="category_id" id="categoryValue" value="{{ old('category_id') }}">

                    <button type="button" class="cr-dropdown-toggle" id="categoryToggle" aria-haspopup="listbox" aria-expanded="false">
                        <span class="icon-chip"><i class="fa-solid fa-tags"></i></span>
                        <span class="cr-dropdown-label {{ old('category_id') ? 'has-value' : '' }}" id="categoryLabel">
                            @php
                                $oldCategory = $categories->firstWhere('id', (int) old('category_id'));
                            @endphp
                            {{ $oldCategory->name ?? 'Select Category' }}
                        </span>
                        <i class="fa-solid fa-chevron-down cr-dropdown-arrow"></i>
                    </button>

                    <div class="cr-dropdown-menu">
                        <ul class="cr-dropdown-list" role="listbox" id="categoryMenu">
                            @foreach($categories as $category)
                                <li role="option"
                                    data-value="{{ $category->id }}"
                                    data-name="{{ strtolower(str_replace(' ', '', $category->name)) }}"
                                    class="{{ (string) old('category_id') === (string) $category->id ? 'selected' : '' }}">
                                    <span class="cr-option-text">
                                        <i class="fa-solid fa-tag cr-option-icon"></i> {{ $category->name }}
                                    </span>
                                    <i class="fa-solid fa-check cr-option-check"></i>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <span class="field-error-msg" id="err-category_id" style="display:none;">Please select a category.</span>
            </div>

            <div class="form-group" id="group-item_date">
                <label><i class="fa-solid fa-calendar-days"></i> Date Lost/Found <span class="required">*</span></label>
<input 
    type="date" 
    name="item_date" 
    id="item_date"
    value="{{ old('item_date') }}" 
    max="{{ date('Y-m-d') }}"
    required>
                <span class="field-error-msg" id="err-item_date" style="display:none;">Please choose a valid date (not in the future).</span>
            </div>
        </div>

        <div class="form-group" id="group-community">
            <label><i class="fa-solid fa-users"></i> Post to Community <span class="optional">(Optional)</span></label>
            @include('partials.community-select', ['myCommunities' => $myCommunities])
        </div>

        <div class="form-group dynamic-field" data-field="mobile" style="display:none">
            <label><i class="fa-solid fa-mobile-screen"></i> IMEI Number <span class="optional">(Optional)</span></label>
            <input type="text" name="imei_number" id="imei_number" value="{{ old('imei_number') }}" placeholder="e.g. 356789104561234" inputmode="numeric" maxlength="17">
            <span class="field-error-msg" id="err-imei_number" style="display:none;">IMEI should be 14–17 digits.</span>
        </div>

        <div class="form-group dynamic-field" data-field="wallet" style="display:none">
            <label><i class="fa-solid fa-wallet"></i> Wallet Type</label>
            <select name="sub_type">
                <option value="">Select</option>
                <option value="leather">Leather</option>
                <option value="fabric">Fabric</option>
                <option value="cardholder">Card Holder</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="form-group dynamic-field" data-field="idcard" style="display:none">
            <label><i class="fa-solid fa-id-card"></i> ID Type</label>
            <select name="sub_type">
                <option value="">Select</option>
                <option value="cnic">CNIC</option>
                <option value="student_card">Student Card</option>
                <option value="driving_license">Driving License</option>
                <option value="employee_card">Employee Card</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="form-group dynamic-field" data-field="keys" style="display:none">
            <label><i class="fa-solid fa-key"></i> What type of keys it is?</label>
            <select name="sub_type">
                <option value="">Select</option>
                <option value="car_keys">Car Keys</option>
                <option value="bike_keys">Bike Keys</option>
                <option value="house_keys">House Keys</option>
                <option value="office_keys">Office Keys</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="form-group dynamic-field" data-field="laptop" style="display:none">
            <label><i class="fa-solid fa-laptop"></i> Serial Number <span class="optional">(Optional)</span></label>
            <input type="text" name="serial_number" value="{{ old('serial_number') }}" placeholder="e.g. C02XY1234ABC">
        </div>

        <div class="form-group dynamic-field" data-field="documents" style="display:none">
            <label><i class="fa-solid fa-file-lines"></i> Document Type</label>
            <select name="sub_type">
                <option value="">Select</option>
                <option value="certificate">Certificate</option>
                <option value="passport">Passport</option>
                <option value="receipt">Receipt / Invoice</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="form-group dynamic-field" data-field="jewelry" style="display:none">
            <label><i class="fa-solid fa-gem"></i> Material</label>
            <select name="sub_type">
                <option value="">Select</option>
                <option value="gold">Gold</option>
                <option value="silver">Silver</option>
                <option value="artificial">Artificial</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="form-group dynamic-field" data-field="other" style="display:none">
            <label><i class="fa-solid fa-circle-question"></i> Please Specify</label>
            <input type="text" name="sub_type_other" id="sub_type_other" value="{{ old('sub_type_other') }}" placeholder="What type of item it is?">
            <span class="field-error-msg" id="err-sub_type_other" style="display:none;">Please specify the item type.</span>
        </div>

        <div class="form-row" id="nameBrandSection" style="display:none;">
    <div class="form-group" id="group-item_name">
        <label><i class="fa-solid fa-box-open"></i> Item Name <span class="required">*</span></label>
        <input type="text" name="item_name" id="item_name" value="{{ old('item_name') }}" placeholder="e.g. iPhone 13 Pro">
        <span class="field-error-msg" id="err-item_name" style="display:none;">Please enter the item name.</span>
    </div>

    <div class="form-group">
        <label><i class="fa-solid fa-industry"></i> Brand / Model</label>
        <input type="text" name="brand" value="{{ old('brand') }}" placeholder="e.g. Apple">
    </div>
</div>

        <!-- Color + Contact -->
        <div class="form-row">
            <div class="form-group">
                <label><i class="fa-solid fa-palette"></i> Color</label>
                <input type="text" name="color" value="{{ old('color') }}" placeholder="e.g. Space Gray">
            </div>

            <div class="form-group" id="group-contact_number">
                <label><i class="fa-solid fa-phone"></i> Contact Number <span class="required">*</span></label>
                <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number') }}" placeholder="03XX-XXXXXXX" required>
                <span class="field-error-msg" id="err-contact_number" style="display:none;">Enter a valid Pakistani mobile number (e.g. 03XX-XXXXXXX).</span>
            </div>
        </div>

        <div class="form-group" id="group-location">
        <label><i class="fa-solid fa-location-dot"></i> Location <span class="required">*</span></label>
        @include('partials.location-select', ['fieldName' => 'location', 'required' => true])
        <span class="field-error-msg" id="err-location" style="display:none;">Please select a location.</span>
        </div>

        <div class="form-group" id="group-description">
            <label><i class="fa-solid fa-align-left"></i> Description <span class="required">*</span></label>
            <textarea name="description" id="description" rows="5" placeholder="Describe the item in detail...">{{ old('description') }}</textarea>
            <span class="field-error-msg" id="err-description" style="display:none;">Please add a description (at least 10 characters).</span>
        </div>

        <div class="form-group">
            <label><i class="fa-solid fa-note-sticky"></i> Additional Identifying Details <span class="optional">(Optional)</span></label>
            <textarea name="verification_notes" rows="3" placeholder="Any scratches, stickers, unique marks...">{{ old('verification_notes') }}</textarea>
        </div>

        <div class="form-group" id="group-photo">
    <label><i class="fa-solid fa-camera"></i> Upload Item Photo <span class="required">*</span></label>
    <div class="upload-box" id="findit-upload-box">
        <input type="file" name="photo" id="findit-photo-input" accept="image/png,image/jpeg,image/jpg,image/webp" required>
        <div class="upload-placeholder" id="findit-upload-placeholder">
            <i class="fa-solid fa-cloud-arrow-up"></i>
            <p>Click or drag a photo here</p>
            <span>PNG, JPG up to 5MB</span>
        </div>
        <img id="findit-photo-preview" class="photo-preview" alt="Preview" style="display:none;">
        <button type="button" id="findit-remove-photo" style="display:none;">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <span class="field-error-msg" id="err-photo" style="display:none;">Please upload a PNG/JPG/WEBP photo up to 5MB.</span>
</div>

        <button type="submit">
            <i class="fa-solid fa-paper-plane"></i> Submit Report
        </button>

    </form>

    @include('footer')
    
<script>

    /* ===========================
       LOST / FOUND THEME
    ============================ */
    const form = document.getElementById("reportForm");
    const typeRadios = document.querySelectorAll('input[name="item_type"]');

    function updateTheme() {
        if (!form) return;
        form.classList.remove("theme-lost", "theme-found");

        const checked = document.querySelector('input[name="item_type"]:checked');
        if (checked) {
            form.classList.add(checked.value === "lost" ? "theme-lost" : "theme-found");
        }
    }

    typeRadios.forEach(function (radio) {
        radio.addEventListener("change", updateTheme);
    });

    updateTheme();

    /* ===========================
       CATEGORY DROPDOWN
       (styled cr-dropdown, replaces the old native <select>)
    ============================ */
    const categoryDropdown = document.getElementById("categoryDropdown");
    const categoryToggle   = document.getElementById("categoryToggle");
    const categoryMenu     = document.getElementById("categoryMenu");
    const categoryLabel    = document.getElementById("categoryLabel");
    const categoryValue    = document.getElementById("categoryValue");

    const dynamicFields = document.querySelectorAll(".dynamic-field");
    const nameBrandSection = document.getElementById("nameBrandSection");

    function currentCategoryName() {
        const selectedLi = categoryMenu ? categoryMenu.querySelector('li.selected') : null;
        return selectedLi ? selectedLi.dataset.name : null;
    }

    function updateDynamicFields() {
        dynamicFields.forEach(function (field) {
            field.style.display = "none";
        });

        if (nameBrandSection) {
            nameBrandSection.style.display = "none";
        }

        const category = currentCategoryName();
        if (!category) return;

        dynamicFields.forEach(function (field) {
            if (field.dataset.field === category) {
                field.style.display = "block";
            }
        });

        if (category === "mobile" || category === "laptop") {
            if (nameBrandSection) nameBrandSection.style.display = "flex";
        }
    }

    if (categoryToggle && categoryDropdown) {
        categoryToggle.addEventListener("click", () => {
            const isOpen = categoryDropdown.classList.toggle("open");
            categoryToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
        });

        document.addEventListener("click", (e) => {
            if (!categoryDropdown.contains(e.target)) {
                categoryDropdown.classList.remove("open");
                categoryToggle.setAttribute("aria-expanded", "false");
            }
        });
    }

    if (categoryMenu) {
        categoryMenu.querySelectorAll("li[role='option']").forEach(option => {
            option.addEventListener("click", () => {
                categoryMenu.querySelectorAll("li").forEach(o => o.classList.remove("selected"));
                option.classList.add("selected");

                categoryValue.value = option.dataset.value;

                const textEl = option.querySelector(".cr-option-text");
                categoryLabel.textContent = textEl ? textEl.textContent.trim() : option.textContent.trim();
                categoryLabel.classList.add("has-value");

                categoryDropdown.classList.remove("open");
                categoryToggle.setAttribute("aria-expanded", "false");

                updateDynamicFields();
                validateCategory();
            });
        });
    }

    updateDynamicFields();

    /* ===========================
       PHOTO PREVIEW
    ============================ */
    const finditUploadBox    = document.getElementById("findit-upload-box");
    const finditPhotoInput   = document.getElementById("findit-photo-input");
    const finditPhotoPreview = document.getElementById("findit-photo-preview");
    const finditPlaceholder  = document.getElementById("findit-upload-placeholder");
    const finditRemoveBtn    = document.getElementById("findit-remove-photo");

    function finditShowPreview(file) {
        if (!file || !file.type.startsWith("image/")) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            finditPhotoPreview.src = e.target.result;
            finditPhotoPreview.style.display = "block";
            finditPlaceholder.style.display = "none";
            finditRemoveBtn.style.display = "flex";
        };
        reader.readAsDataURL(file);
    }

    function finditResetPreview() {
        finditPhotoInput.value = "";
        finditPhotoPreview.src = "";
        finditPhotoPreview.style.display = "none";
        finditPlaceholder.style.display = "block";
        finditRemoveBtn.style.display = "none";
    }

    if (finditPhotoInput) {
        finditPhotoInput.addEventListener("change", function () {
            finditShowPreview(this.files[0]);
            validatePhoto(); // live validation feedback
        });
    }

    if (finditRemoveBtn) {
        finditRemoveBtn.addEventListener("click", function (e) {
            e.stopPropagation();
            finditResetPreview();
        });
    }

    if (finditUploadBox) {
        finditUploadBox.addEventListener("dragover", function (e) {
            e.preventDefault();
            finditUploadBox.classList.add("dragover");
        });

        finditUploadBox.addEventListener("dragleave", function () {
            finditUploadBox.classList.remove("dragover");
        });

        finditUploadBox.addEventListener("drop", function (e) {
            e.preventDefault();
            finditUploadBox.classList.remove("dragover");

            const file = e.dataTransfer.files[0];
            if (file) {
                finditPhotoInput.files = e.dataTransfer.files;
                finditShowPreview(file);
                validatePhoto();
            }
        });
    }

    /* ===========================
       VALIDATION
    ============================ */
    const MAX_PHOTO_BYTES = 5 * 1024 * 1024; // 5MB
    const ALLOWED_PHOTO_TYPES = ["image/png", "image/jpeg", "image/jpg", "image/webp"];
    const PK_PHONE_REGEX = /^03\d{2}-?\d{7}$/; // 03XX-XXXXXXX or 03XXXXXXXXX

    function showFieldError(groupEl, errEl) {
        if (groupEl) groupEl.classList.add("field-error");
        if (errEl) errEl.style.display = "block";
    }

    function clearFieldError(groupEl, errEl) {
        if (groupEl) groupEl.classList.remove("field-error");
        if (errEl) errEl.style.display = "none";
    }

    function validateItemType() {
        const checked = document.querySelector('input[name="item_type"]:checked');
        const group = document.getElementById("typeSelectGroup");
        const err = document.getElementById("err-item_type");
        if (!checked) {
            showFieldError(group, err);
            return "Please select whether the item is Lost or Found.";
        }
        clearFieldError(group, err);
        return null;
    }

    function validateCategory() {
        const group = document.getElementById("group-category_id");
        const err = document.getElementById("err-category_id");
        if (!categoryValue || !categoryValue.value) {
            showFieldError(group, err);
            return "Please select a category.";
        }
        clearFieldError(group, err);
        return null;
    }

    function validateDate() {
        const dateInput = document.getElementById("item_date");
        const group = document.getElementById("group-item_date");
        const err = document.getElementById("err-item_date");
        if (!dateInput.value) {
            showFieldError(group, err);
            return "Please choose the date the item was lost/found.";
        }
        const chosen = new Date(dateInput.value + "T00:00:00");
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        if (chosen > today) {
            showFieldError(group, err);
            return "Date cannot be in the future.";
        }
        clearFieldError(group, err);
        return null;
    }

    function validateImei() {
        const imeiInput = document.getElementById("imei_number");
        const err = document.getElementById("err-imei_number");
        if (!imeiInput) return null; // field hidden / not in DOM path for this category
        const val = imeiInput.value.trim();
        if (val === "") {
            err.style.display = "none";
            return null; // optional field
        }
        if (!/^\d{14,17}$/.test(val)) {
            err.style.display = "block";
            return "IMEI should be 14–17 digits (numbers only).";
        }
        err.style.display = "none";
        return null;
    }

    function validateOtherCategory() {
        const category = currentCategoryName();
        if (category !== "other") return null;
        const input = document.getElementById("sub_type_other");
        const err = document.getElementById("err-sub_type_other");
        if (!input || !input.value.trim()) {
            if (err) err.style.display = "block";
            return "Please specify the item type.";
        }
        if (err) err.style.display = "none";
        return null;
    }

    function validateItemName() {
        const category = currentCategoryName();
        if (category !== "mobile" && category !== "laptop") return null;
        const input = document.getElementById("item_name");
        const group = document.getElementById("group-item_name");
        const err = document.getElementById("err-item_name");
        if (!input || !input.value.trim()) {
            showFieldError(group, err);
            return "Please enter the item name.";
        }
        clearFieldError(group, err);
        return null;
    }

    function validateContact() {
        const input = document.getElementById("contact_number");
        const group = document.getElementById("group-contact_number");
        const err = document.getElementById("err-contact_number");
        const val = input.value.trim();
        if (!val) {
            showFieldError(group, err);
            return "Please enter a contact number.";
        }
        if (!PK_PHONE_REGEX.test(val)) {
            showFieldError(group, err);
            return "Enter a valid Pakistani mobile number (e.g. 0300-1234567).";
        }
        clearFieldError(group, err);
        return null;
    }

    function validateLocation() {
    const input = document.querySelector('input[name="location"]');
    const group = document.getElementById("group-location");
    const err = document.getElementById("err-location");
    if (!input || !input.value.trim()) {
        showFieldError(group, err);
        return "Please select a location.";
    }
    clearFieldError(group, err);
    return null;
}

    function validateDescription() {
        const input = document.getElementById("description");
        const group = document.getElementById("group-description");
        const err = document.getElementById("err-description");
        const val = input.value.trim();
        if (val.length < 10) {
            showFieldError(group, err);
            return "Description must be at least 10 characters.";
        }
        clearFieldError(group, err);
        return null;
    }

    function validatePhoto() {
        const group = document.getElementById("group-photo");
        const err = document.getElementById("err-photo");
        const file = finditPhotoInput.files && finditPhotoInput.files[0];

        if (!file) {
            showFieldError(group, err);
            if (finditUploadBox) finditUploadBox.classList.add("field-error");
            return "Please upload a photo of the item.";
        }
        if (!ALLOWED_PHOTO_TYPES.includes(file.type)) {
            showFieldError(group, err);
            err.textContent = "Only PNG, JPG, or WEBP images are allowed.";
            if (finditUploadBox) finditUploadBox.classList.add("field-error");
            return "Only PNG, JPG, or WEBP images are allowed.";
        }
        if (file.size > MAX_PHOTO_BYTES) {
            showFieldError(group, err);
            err.textContent = "Photo must be 5MB or smaller.";
            if (finditUploadBox) finditUploadBox.classList.add("field-error");
            return "Photo must be 5MB or smaller.";
        }
        clearFieldError(group, err);
        if (finditUploadBox) finditUploadBox.classList.remove("field-error");
        return null;
    }

    function runAllValidations() {
        const errors = [
            validateItemType(),
            validateCategory(),
            validateDate(),
            validateImei(),
            validateOtherCategory(),
            validateItemName(),
            validateContact(),
            validateLocation(),
            validateDescription(),
            validatePhoto()
        ].filter(Boolean);

        return errors;
    }

    function showAlertSummary(errors) {
        const alertBox = document.getElementById("jsAlert");
        const list = document.getElementById("jsAlertList");
        list.innerHTML = "";

        if (errors.length === 0) {
            alertBox.style.display = "none";
            return;
        }

        errors.forEach(function (msg) {
            const li = document.createElement("li");
            li.textContent = msg;
            list.appendChild(li);
        });

        alertBox.style.display = "block";
        alertBox.scrollIntoView({ behavior: "smooth", block: "start" });
    }

    // Live validation as the user interacts
    [
        ["item_date", validateDate],
        ["imei_number", validateImei],
        ["sub_type_other", validateOtherCategory],
        ["item_name", validateItemName],
        ["contact_number", validateContact],
        ["description", validateDescription]
    ].forEach(function (pair) {
        const el = document.getElementById(pair[0]);
        if (el) {
            el.addEventListener("blur", pair[1]);
            el.addEventListener("input", pair[1]);
        }
    });

    typeRadios.forEach(function (radio) {
        radio.addEventListener("change", validateItemType);
    });

    if (form) {
        form.addEventListener("submit", function (e) {
            const errors = runAllValidations();
            if (errors.length > 0) {
                e.preventDefault();
                showAlertSummary(errors);
            } else {
                showAlertSummary([]);
            }
        });
    }

</script>
<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="pWqLqk5Y3XFJodIGm8Ue0";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
</body>
</html>