<style>
    #snackbar {
        visibility: hidden;
        min-width: 250px;
        margin-right: -125px;
        background-color: red;
        color: #fff;
        text-align: center;
        border-radius: 4px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        right: 1%;
        top: 100px;
        font-size: 17px;
    }

    #snackbar.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @-webkit-keyframes fadein {
        from {
            top: 0;
            opacity: 0;
            margin-right: 0;
        }
        to {
            top: 100px;
            opacity: 1;
            margin-right: 0;
        }
    }

    /*@keyframes fadein {*/
    /*    from {*/
    /*        top: 0;*/
    /*        opacity: 0;*/
    /*    }*/
    /*    to {*/
    /*        top: 100px;*/
    /*        opacity: 1;*/
    /*    }*/
    /*}*/

    /*@-webkit-keyframes fadeout {*/
    /*    from {*/
    /*        top: 100px;*/
    /*        opacity: 1;*/
    /*    }*/
    /*    to {*/
    /*        top: 0;*/
    /*        opacity: 0;*/
    /*    }*/
    /*}*/

    /*@keyframes fadeout {*/
    /*    from {*/
    /*        top: 100px;*/
    /*        opacity: 1;*/
    /*    }*/
    /*    to {*/
    /*        top: 0;*/
    /*        opacity: 0;*/
    /*    }*/
    /*}*/
</style>

<div id="snackbar" class="bg-danger">Some text some message..</div>
