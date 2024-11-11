<!-- Vendor CSS -->
<link rel="stylesheet" href="{{ asset("assets/vendor/bootstrap/css/bootstrap.css") }}"/>
<link rel="stylesheet" href="{{ asset("assets/vendor/animate/animate.compat.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/font-awesome/css/all.min.css") }}"/>
<link rel="stylesheet" href="{{ asset("assets/vendor/boxicons/css/boxicons.min.css") }}"/>
<link rel="stylesheet" href="{{ asset("assets/vendor/magnific-popup/magnific-popup.css") }}"/>
<link rel="stylesheet" href="{{ asset("assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css") }}"/>
<link rel="stylesheet" href="{{ asset("assets/vendor/jquery-ui/jquery-ui.css") }}"/>
<link rel="stylesheet" href="{{ asset("assets/vendor/jquery-ui/jquery-ui.theme.css") }}"/>
<link rel="stylesheet" href="{{ asset("assets/vendor/bootstrap-multiselect/css/bootstrap-multiselect.css") }}"/>
<link rel="stylesheet" href="{{ asset("assets/vendor/morris/morris.css") }}"/>
<link rel="stylesheet" href="{{ asset("assets/vendor/simple-line-icons/css/simple-line-icons.css") }}"/>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset("assets/css/theme.css") }}"/>

<!-- Skin CSS -->
<link rel="stylesheet" href="{{ asset("assets/css/skins/default.css") }}"/>

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="{{ asset("assets/css/custom.css") }}">
<link rel="stylesheet" href="{{ asset("assets/css/pikaday.css") }}">

<style>
    .preloader {
        display: -ms-flexbox;
        display: flex;
        background-color: #f4f6f9;
        height: 100vh;
        width: 100%;
        transition: height 200ms linear;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 9999;
    }

    .select2-hidden-accessible {
        display: none !important;
        visibility: hidden !important;
    }

    .toast-container {
        position: fixed;
        bottom: 10px;
        right: 10px;
        z-index: 1060;
    }

    /* Important part */
    .modal-dialog{
        overflow-y: initial !important
    }
    .modal-body{
        max-height: calc(100vh - 200px);
        overflow-y: auto;
    }
    .model{
        z-index: 1052!important;
    }

/*  Loading  */

    .lds-facebook,
    .lds-facebook div {
        box-sizing: border-box;
    }
    .lds-facebook {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }
    .lds-facebook div {
        display: inline-block;
        position: absolute;
        left: 8px;
        width: 16px;
        background: currentColor;
        animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
    }
    .lds-facebook div:nth-child(1) {
        left: 8px;
        animation-delay: -0.24s;
    }
    .lds-facebook div:nth-child(2) {
        left: 32px;
        animation-delay: -0.12s;
    }
    .lds-facebook div:nth-child(3) {
        left: 56px;
        animation-delay: 0s;
    }
    @keyframes lds-facebook {
        0% {
            top: 8px;
            height: 64px;
        }
        50%, 100% {
            top: 24px;
            height: 32px;
        }
    }


    /*  Loading  */
</style>
<!-- Head Libs -->
<script src="{{ asset("assets/vendor/modernizr/modernizr.js") }}"></script>
