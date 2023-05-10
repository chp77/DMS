<template>
    <tbody>
    <tr>
        <td colspan="12" class="loader-wrapper">
            <span>DATA IS LOADING...</span>
            <div class="loader"></div>
        </td>
    </tr>
    </tbody>
</template>
<style>
    .loader-wrapper {
        padding: 0 32px;
        text-align: center;
        font-size: 200%;
    }
    .loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        margin: 32px auto;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
