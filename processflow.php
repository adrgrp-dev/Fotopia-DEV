<style>

.wizard {
    margin: 20px auto;
    background: #fff;
}

    .wizard .nav-tabs {
        position: relative;
        margin: 0px auto;
        margin-bottom: 0;
        border-bottom: none;
    }

    .wizard > div.wizard-inner {
        position: relative;
		text-align:center;
    }

.connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width: 60%;
    margin: 0 0;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

span.round-tab {
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: #fff;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 25px;
}
span.round-tab i{
    color:#555555;
}
.wizard li.active span.round-tab {
    background: #fff;
    border: 2px solid #5bc0dd;
	box-shadow:5px 5px 5px #8bd8ef;

}
.wizard li.active span.round-tab i{
    color: #5bc0de;
}

span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}

.wizard .nav-tabs > li {
    width: 30%;
}




.wizard .nav-tabs > li a {
    width: 70px;
    height: 70px;
    margin: 0 0;
    border-radius: 100%;
    padding: 0;
}

    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }

.wizard .tab-pane {
    position: relative;
    padding-top: 50px;
}

.wizard h3 {
    margin-top: 0;
}

@media( max-width : 585px ) {

    .wizard {
        width: 90%;
        height: auto !important;
    }

    span.round-tab {
        font-size: 16px;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard .nav-tabs > li a {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }


}
</style>

<div class="wizard-inner">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10">
    <div class="connecting-line"></div>
    <ul class="nav nav-tabs">

        <li role="presentation" class="active">
            <a href="#">
                <span class="round-tab">
                    <i class="fa fa-building-o"></i> <h5 style="text-align:center;color:#5bc0dd;font-weight:600;">Create Order</h5>
                </span>
            </a>
        </li>

        <li>
            <a href="#">
                <span class="round-tab">
                    <i class="fa fa-calendar"></i><h5 style="text-align:center">Create Appointment</h5>
                </span>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="round-tab">
                    <i class="fa fa-check"></i><h5 style="text-align:center">Order Summary</h5>
                </span>
            </a>
        </li>


    </ul>
</div>

</div>
