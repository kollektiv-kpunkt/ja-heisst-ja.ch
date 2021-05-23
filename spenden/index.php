<?php
include "../elements/header.elem.php";
?>

<div class="section">
    <div class="sm-cont section-cont">
        <h2 class="form-title"><?= $lang_menu2 ?></h2>
        <p class="form-lead"><?= $lang_spenden ?></p>
        <div class="rnw-widget-container"></div>
        <script src="https://tamaro.raisenow.com/sp-schweiz/latest/widget.js"></script>
        <script>
            window.rnw.tamaro.runWidget('.rnw-widget-container', {
                language: '<?= $lang ?>',
                testMode: false,
                debug: false,
                purposes: ['p1'],
                purposeDetails: {
                p1: {
                    stored_campaign_id: 28894245,
                },
            },
            paymentTypes: [
            	'onetime',
            	//'recurring'
            ],
            translations: {
                de: {
                    purposes: {
                        p1: 'Nur Ja heisst Ja',
                    },
                    /*amount_descriptions: [
                        {
                            "if": "paymentType() == onetime",
                            "then": [
                                {
                                    "if": "amount() == 50",
                                    "then": "TEXT1"
                                },
                                {
                                    "if": "amount() == 100",
                                    "then": "TEXT2"
                                },
                                {
                                    "if": "amount() == 200",
                                    "then": "TEXT3"
                                },
                                {
                                    "if": "amount() == 400",
                                    "then": "TEXT4"
                                },
                                {
                                    "if": "amount() == custom_amount",
                                    "then": "TEXT5"
                                }
                            ]
                        },
                    ]*/
                },
                fr: {
                    purposes: {
                        p1: 'Seul un oui est un oui',
                    },
                    /*amount_descriptions: [
                        {
                            "if": "paymentType() == onetime",
                            "then": [
                                {
                                    "if": "amount() == 50",
                                    "then": "TEXT1"
                                },
                                {
                                    "if": "amount() == 100",
                                    "then": "TEXT2"
                                },
                                {
                                    "if": "amount() == 200",
                                    "then": "TEXT3"
                                },
                                {
                                    "if": "amount() == 400",
                                    "then": "TEXT4"
                                },
                                {
                                    "if": "amount() == custom_amount",
                                    "then": "TEXT5"
                                }
                            ]
                        },
                    ]*/
                },
                it: {
                    purposes: {
                        p1: 'PS Svizzero',
                    },
                    /*amount_descriptions: [
                        {
                            "if": "paymentType() == onetime",
                            "then": [
                                {
                                    "if": "amount() == 50",
                                    "then": "TEXT1"
                                },
                                {
                                    "if": "amount() == 100",
                                    "then": "TEXT2"
                                },
                                {
                                    "if": "amount() == 200",
                                    "then": "TEXT3"
                                },
                                {
                                    "if": "amount() == 400",
                                    "then": "TEXT4"
                                },
                                {
                                    "if": "amount() == custom_amount",
                                    "then": "TEXT5"
                                }
                            ]
                        },
                    ]*/
                }, 
            },
                showStoredCustomerEmailPermission: false,
                paymentFormPrefill: {
                    stored_customer_email_permission: true,
                    stored_customer_donation_receipt: true,
                    stored_customer_country: 'CH',
                    stored_sxt_address_source: '1008',
                    //stored_sxt_product_id: '1037',
                    //stored_hidden_parameter: 'myValue',
                },
                amounts: [
                    {
                        "if": "paymentType() == onetime",
                        "then": [25,50,100,200],
                    },
                    {
                        "if": "recurringInterval() == monthly && paymentType() == recurring",
                        "then": [10,20,30,50],
                    },
                    {
                        "if": "recurringInterval() == quarterly && paymentType() == recurring",
                        "then": [30,60,90,150],
                    },
                    {
                        "if": "recurringInterval() == semestral && paymentType() == recurring",
                        "then": [60,120,180,300],
                    },
                    {
                        "if": "recurringInterval() == yearly && paymentType() == recurring",
                        "then": [120,240,360,600],
                    },
                ],
                paymentSlipDeliveryTypes: [
                    {
                        "if": "paymentType() == onetime",
                        "then": ['download','mail'],
                    },
                    {
                        "if": "paymentType() == recurring",
                        "then": ['mail'],
                    },
                ],
                //minimumCustomAmount: [15],
                //allowCustomAmount: true,
                //layout: 'list',
            })
        </script>

        <style>
            :root {
            --tamaro-primary-color: #36006B;
            --tamaro-primary-color__hover: rgba(54,0,107,0.75);
            --tamaro-primary-bg-color: rgba(54,0,107,0.03);
            --tamaro-border-color: #b5b5b5;
                /*font-size: inherit;*/
            }      
        </style>
    </div>
</div>
<div id="bottom-bar" class="nofix">
    <div class="sm-cont" id="bottom-bar-inner">
        <div id="footer-copyright">
            <p class="text_small">© 2020, SP Schweiz</p>
        </div>
        <div id="footer-creds">
            <p class="text_small">Made with ❤️ in Zurich | <a href="/datenschutz" target="_blank">Datenschutz</a> | <a href="https://kpunkt.ch" target="_blank">Development by <strong>K.</strong></a></p>
        </div>
    </div>
</div>

<style>
    #nav-head {display: none;}
    #scroll-head {
        top: 0;
        visibility: visible;
        opacity: 1;
    }
</style>
<?php
include "../elements/footer.elem.php";
?>