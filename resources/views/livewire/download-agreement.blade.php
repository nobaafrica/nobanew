<div>
    <x-slot name="header">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Partnership</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('partnerships')}}">Partneships</a></li>
                            <li class="breadcrumb-item active">{{$partnership->package->name}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </x-slot> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="mt-4 mt-xl-3">
                                <h6 class="text-center mb-5">Partnership Agreement</h6>
                                <div id="printable">
                                    <div class="text-center">
                                        <h2 class="mb-5">MEMORANDUM OF UNDERSTANDING</h2>
                                        <h4 class="mb-5">BETWEEN</h5>
                                        <h5>NOBA AFRICA AGRO-ALLIED LIMITED</h5>
                                        <h5 class="mb-4">(MANAGING PARTY)</h5>
                                        <h4 class="mb-5">AND</h5>
                                        <h5>{{$partnership->user->firstName}} {{$partnership->user->lastName}}</h5>
                                        <h5 class="mb-5">(INVESTING PARTY)</h5>
                                        <h5 class="mb-4">(IN RESPECT OF INVESTMENT IN AGRICULTUTAL PRODUCTS AND ALLIED BUSINESS TRANSACTIONS)</h5>
                                        <h5 class="mb-5">MADE THIS {{\Carbon\Carbon::parse($partnership->created_at)->format('jS')}} DAY OF {{\Carbon\Carbon::parse($partnership->created_at)->format('F, Y')}}</h6>
                                        <h5><b>PREPARED BY:</b></h5>
                                        <h5>OLUFUNSHO ISAAC ESQ. <br>
                                            OLUFUNSHO ISAAC & Co <br>
                                            28, BLANTYRE ST, WUSE 2 <br>
                                            FCT-ABUJA <br>
                                            080329931306 <br>
                                        </h5>
                                    </div>
                                    <div class="mt-5 text-left">
                                        <h5 class="text-center"><u>MEMORANDUM OF UNDERSTANDING</u></h5>
                                        <p>This Memorandum is made this {{\Carbon\Carbon::parse($partnership->created_at)->format('jS')}} day of {{\Carbon\Carbon::parse($partnership->created_at)->format('F Y')}}</p>
                                        <h5 class="mb-4">BETWEEN</h5>
                                        <h6 class="mb-4">NOBA AFRICA AGRO-ALLIED LIMITED, of 18, Plot 338, Queen Elizabeth Street, Asokoro, Abuja, Federal Capital Territory, Nigeria, hereinafter referred to as THE MANAGING PARTY (which expression shall where the context so admits, include its Agents Personal Representatives and Assigns) of the FIRST PART.</h6>
                                        <h5 class="mb-4">AND</h5>
                                        <p><b>{{$partnership->user->name}}</b> of {{$partnership->user->address}}, hereinafter refers to as THE INVESTING PARTY (which expression shall where the context so admits, include its Agents, Personal Representatives and Assigns) of the <span class="h6">OTHER PART.</span></p>
                                        <ol type="1">
                                            <li>
                                                <h6><u>WHEREAS</u></h6>
                                                <ol type="A">
                                                    <li>
                                                        <p><b>NOBA AFRICA AGRO-ALLIED LIMITED: </b>a company limited by share, which is duly registered under the law of the Federal Republic of Nigeria whose objectives amongst others include carrying on the business of trading in agricultural commodities, procurement, sales and supply of agricultural products such as: soybeans, paddy rice, maize grains, cowpeas, wheat amongst others and other related investments across different parts of Nigeria</p>
                                                    <li>    
                                                    <li>    
                                                        <p><b>The INVESTING PARTY </b>is committed to partnering with Noba Africa Ltd in the trade of agro commodities business operations in Kebbi, Niger, Katsina and other states of the  states of the Federal where there are produce for purchase or demand for supplies as the case may be.</p>
                                                    </li>    
                                                </ol>
                                            </li>
                                            <li>
                                                <h6><u>THE PARTIES HEREBY AGREE AS FOLLOWS:</u></h6>
                                                <ol type="1">
                                                    <li>
                                                        <p><b>The INVESTING PARTY</b>The INVESTING PARTY agreed to commit a sum of NGN{{number_format($partnership->amount)}} <span class="text-capitalize">({{numberToWord($partnership->amount)}}</span> Naira only) to fund the business activities of  the MANAGING PARTY (Noba Africa Ltd) to enable the latter to continue to carry on the business of commodity trading as described in this agreement</p>
                                                    </li>
                                                    <li>
                                                        <p><b>The MANAGING PARTY</b>is expected to carry on this business with the funds provided by INVESTING PARTY for a period of {{$partnership->package->duration}} months after which the INVESTING PARTY is due to receive the total amount committed to the business with accruing interest of {{$partnership->package->profitPercentage}}%  the MANAGING PARTY.</p>
                                                    </li>
                                                    <li>
                                                        <p>Each fund or investment released for this purpose shall attract the same {{$partnership->package->percentageProfit}}% after the agreed duration</p>
                                                    </li>
                                                    <li>
                                                        <p><b>The INVESTING PARTY</b>agrees to invest more funds into the agro-commodity business of the MANAGING PARTY depending on the availability of funds to be released for the business</p>
                                                    </li>
                                                    <li>
                                                        <p>Each fund released at different intervals shall have its accruing interest being calculated from the moment or date such investment or investments were made without more.</p>
                                                    </li>
                                                    <li>
                                                        <p>The <b>INVESTING PARTY</b> agrees to introduce or link <b>MANAGING PARTY</b> to any useful information or contact that can aid the smooth operation of the agro-commodity trade in any part of the country.</p>
                                                    </li>
                                                    <li>
                                                        <p>
                                                            In the event of its willingness to cash out on either the capital investment, its accruing interest and or both, a sufficient demand notice of one calendar month shall be issued and served on the <b>MANAGING PARTY</b> at its office address, through email or the available social media channels. This notice is necessary given the nature of the <b>MANAGING PARTY’S</b> business so as to have ample time to arrange, schedule and ascertain payment without default.
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p>Upon service of notice of demand for payment as aforementioned, the <b>MANAGING PARTY</b> shall forthwith give a written response as to the particular details on how payment shall be effected. The said response shall contain information relating to the exact date of payment and other details.</p>
                                                    </li>
                                                    <li>
                                                        <p>In the event of foreseeable delay in payment, such shall be communicated promptly so that the parties can jointly agree on feasible date for cash out.</p>
                                                    </li>
                                                </ol>
                                            </li>
                                            <li>
                                                <h6><u>BUSINESS SITES OR LOCATIONS</u></h6>
                                                <p>The <b>MANAGING PARTY</b> shall operate its business activities in any or all state of the Federation where farm produce are available for purchase or where there are demands for supplies of identified agricultural produce.</p>
                                            </li>
                                            <li>
                                                <h6><u>SCOPE OF WORK</u></h6>
                                                <p>The Scope of work fully encapsulated in the project proposal.</p>
                                            </li>
                                            <li>
                                                <h6><u>PARTICIPATION OF THIRD PARTIES</u></h6>
                                                <p>Either Party may invite a third party to take part in business activities carried out under this MOU upon the agreement of the other party and agreement that the third party is necessary for the successful implementation of this investment. In line with the implementation activities, the parties shall ensure that the third party shall comply with the provisions of this MOU.</p>
                                            </li>
                                            <li>
                                                <h6><u>DISSEMINATION OF INFORMATION AND PROTECTION OF INTELLECTUAL PROPERTY RIGHTS</u></h6>
                                                <p>Intellectual property rights shall be protected and enforced by each Party in accordance with the national laws, rules and regulations and any international agreements to which it is a party.</p>
                                            </li>
                                            <li>
                                                <h6><u>FURTHER AGREEMENTS OF THE PARTIES</u></h6>
                                                <p>It is hereby mutually agreed as follows:</p>
                                                <ol>
                                                    <li>
                                                        <p>Both parties shall ensure that any agents, servants, employees or 	cronies including subcontractors, partners or agencies shall undertake /agree to be bound by the same restrictions and conditions listed in this agreement.</p>
                                                    </li>
                                                    <li>
                                                        <p>The parties to this memorandum accept liability for any action 	that may arise in the event of a breach of this agreement by any party, its employees, servants, delegates or subcontractors. The other party who is not in breach shall be exculpated from any liability that may so arise.</p>
                                                    </li>
                                                    <li>
                                                        <p>In the event of being provided/presented with the firsthand information or pre-emption as to the likely breach as indicated above, both parties shall report same within 24 hours.</p>
                                                    </li>
                                                </ol>
                                            </li>
                                            <li>
                                                <h6><u>DEPLOYMENT OF PERSONNEL FOR PRODUCE COLELECTION/ AND DELIVERY TO CLIENTS</u></h6>
                                                <p>The <b>MANAGING PARTY</b> shall be solely involved in the deployment of its personnel for the business activities and shall collect/gather, and or deliver produce to its clients based on their demands.</p>
                                            </li>
                                            <li>
                                                <h6><u>QUALITY OF PRODUCTS</u></h6>
                                                <p>The MANAGING PARTY shall ascertain that the agricultural products which form the subject matter of this memorandum of understanding are of the highest quality to prevent any form of issues with regards to inspection /satisfaction which may lead to rejection by the clients thereby resulting in loss of investment.</p>
                                            </li>
                                            <li>
                                                <h6><u>SAFETY AND INSPECTION OF WORK</u></h6>
                                                <p>The MANAGING PARTY shall follow all the international safety standard procedures and regulations with regard to its line of business. The INVESTING PARTY may be provided with a copy of safety regulations in force, safety permit and procedure necessary to be complied with.</p>
                                            </li>
                                            <li>
                                                <h6><u>COMMENCEMENT OF WORK</u></h6>
                                                <p>The project shall commence on the date written above and it shall last for only a period of 12 (Twelve) calendar months. The end date can be extended by mutual agreement and in writing by both parties.</p>
                                            </li>
                                            <li>
                                                <h6><u>INSURANCE:</u></h6>
                                                <p><b>The MANAGING PARTY shall make efforts to insure her products, services or investment against all forms of risks so as to safeguard the investment and the business interest of the INVESTING PARTY</b></p>
                                            </li>
                                            <li>
                                                <h6><u>INDEMNIFICATION</u></h6>
                                                <p>The MANAGING PARTY undertakes to indemnify the INVESTING PARTY against all losses and expenses, fraud, claims awarded, demands, liabilities, actions, damages and proceedings made by any third party that may affect this investment</p>
                                            </li>
                                            <li>
                                                <h6><u>ASSIGNMENT</u></h6>
                                                <p>Neither this MOU, nor any rights or obligations hereunder may be assigned, 	delegated or conveyed by either Party without the prior written consent of 	the other Party.</p>
                                            </li>
                                            <li>
                                                <h6><u>TAXES, LEVIES, AND DUTIES</u></h6>
                                                <p>The <b>INVESTING PARTY</b> and <b>The MANAGING PARTY</b> shall bear and pay all taxes and duties in connection with the investment as may be payable under the relevant laws of the Federal Republic of Nigeria.</p>
                                            </li>
                                            <li>
                                                <h6><u>ENTRY INTO FORCE, DURATION AND TERMINATION</u></h6>
                                                <ol>
                                                    <li>
                                                        <p>
                                                            This MOU shall come into force on the date of signing and shall remain in force for a period of {{numberToWord($partnership->package->duration)}} ({{$partnership->package->duration}}) Calendar months.
                                                        </p>
                                                    </li>
                                                    <li><p>Extension of the MOU for any duration of time shall be by mutual agreement of both parties.</p></li>
                                                    <li><p>Notwithstanding anything in this Article, either Party may terminate this MOU by notifying the other Party in writing at least thirty (30) days prior to its intention to do so.</p></li>
                                                    <li><p>Upon termination, cancellation or expiration of this Agreement, the MANAGING PARTY shall, without delay upon request of the INVESTING PARTY, return or refund all the money invested with its accruing interest within a period of 1(One) Month as stipulated above.</p></li>
                                                    <li><p>Unless otherwise agreed by the Parties in writing, the termination of this MOU shall not affect the implementation of any activity undertaken under this MOU and not yet completed at the time of the termination of this MOU. Either party may give the other One Month’s notice to terminate investment.</p></li>
                                                </ol>
                                            </li>
                                            <li>
                                                <h6><u>SCOPE OF WORK</u></h6>
                                                <p>The Scope of work fully encapsulated in the project proposal.</p>
                                            </li>
                                            <li>
                                                <h6><u>SCOPE OF WORK</u></h6>
                                                <p>The Scope of work fully encapsulated in the project proposal.</p>
                                            </li>
                                        </ol>
                                    </div>
                                  </div>
                                </div>
                                <div class="text-center">
                                    <button wire:click='exportPdf' class="btn btn-primary">Download Agreement</button>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <!-- end row -->
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
</div>
