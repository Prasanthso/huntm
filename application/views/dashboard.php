<? include layout.php ?>
    <title>Mini Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
		
	/* for dashboard styles */
	.content {
            margin-left: 260px; /* Push content to the right */
            padding: 20px;
        }
		card{widht:100%;}
		.dashboard-card {
		
            padding: 20px;
			width: 200px;
			height: 100px;
            border-radius: 20px;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .card-1 { background:rgb(200, 208, 216); color: #333; }
        .card-2 { background: #e3f2fd; color: #01579b; }
        .card-3 { background: #e8f5e9; color: #1b5e20; }
        .card-4 { background: #fff3e0; color: #e65100; }
        .card-5 { background: #fce4ec; color: #880e4f; }
        .card-6 { background: #ede7f6; color: #4527a0; }
        .card-7 { background: #ffebee; color: #b71c1c; }
        .card-8 { background: #e0f7fa; color: #006064; }
        .card-9 { background: #fff8e1; color: #ff8f00; }
        .card-10 { background: #f1f8e9; color: #33691e; }
        .card-11 { background: #ede7f6; color: #4a148c; }
        .card-12 { background: #d7ccc8; color: #5d4037; }
        .card-13 { background: #fbe9e7; color: #bf360c; }
        .card-14 { background: #d1c4e9; color: #311b92; }
        .card-15 { background:rgb(176, 229, 162); color: #283593; }
        .card-16 { background: #b2dfdb; color: #004d40; }
       
    </style>
</head>
<body>
				 
<div class="content">
<div class="container-sm mt-3">
<div class="row row-cols-3 g-4 mr-0 pr-0">
    
        <div class="col-md-4">
            <div class="card text-center dashboard-card card-1"  onclick="showDetails('backlog')">
                <h6>👥 Backlog</h6>
                <p class="fs-5">Areas:150</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-2" onclick="showDetails('fundbalance')">
                <h6>📦 Fund Balance</h6>
                <p class="fs-5">$320</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-3"  onclick="showDetails('customers')">
                <h6>👨‍💼 Customer Strength</h6>
                <p class="fs-5">495</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-4"  onclick="showDetails('sbc')">
                <h6>🛍️ SBC</h6>
                <p class="fs-5">Qty:50</p>
            </div>
        </div>

        <div class="col">
            <div class="card text-center dashboard-card card-6" onclick="showDetails('nilrefill')">
                <h6>📝 Nil Refill</h6>
                <p class="fs-5">85</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-7"  onclick="showDetails('kyc')">
                <h6>🔄  KYC</h6>
                <p class="fs-5">20</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-8"  onclick="showDetails('mi-due')">
                <h6>📈 MI Due</h6>
                <p class="fs-5">8,000</p>
            </div>
        </div>

        <div class="col">
            <div class="card text-center dashboard-card card-9"  onclick="showDetails('hose-due')">
                <h6>🏭 Hose Due</h6>
                <p class="fs-5">10</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-10"  onclick="showDetails('mobileno')">
                <h6>🆕 Mobile No</h6>
                <p class="fs-5">120</p>
            </div>
        </div>
      

    </div>
	<!-- 🔽 Details Section Below the Cards -->
    <div id="details" class="mt-4" style="display: none;">
        <h4 id="details-title"></h4>
        <ul id="details-list" class="list-group"></ul>
    </div>
</div>
</div>
    <script>
       
		function showDetails(type) {
    let title = document.getElementById('details-title');
    let list = document.getElementById('details-list');
    let detailsSection = document.getElementById('details');

    list.innerHTML = ''; // Clear previous data

    if (type === 'backlog') {
        title.innerText = '👥 Backlog';
        list.innerHTML = `
            <li class="list-group-item"> No of.Area : 50</li>
            <li class="list-group-item"> 🕒 Pending Qty: 2</li>
            <li class="list-group-item"> ✅ Open Qty: 50</li>
			<li class="list-group-item">  Total : 52</li>`;
    } 
    else if (type === 'fundbalance') {
        title.innerText = '📦 Fundbalance Details';
        list.innerHTML = `
            <li class="list-group-item">Balance 💲123 </li>`;
    } 
    // else if (type === 'revenue') {
    //     title.innerText = '💰 Revenue Breakdown';
    //     list.innerHTML = `
    //         <li class="list-group-item">January: 💲3,500</li>
    //         <li class="list-group-item">February: 💲4,200</li>`;
    // } 
    else if (type === 'sbc') {
        title.innerText = '👨‍💼 SBC Customers';
        list.innerHTML = `
            <li class="list-group-item"> Qty : 100 </li>
            <li class="list-group-item"> Percentage: 10%</li>`;
    } 
    else if (type === 'customers') {
        title.innerText = '👨‍💼 Customers Strength';
        list.innerHTML = `
            <li class="list-group-item"> Active: 450 </li>
            <li class="list-group-item"> Suspended : 5</li>
			<li class="list-group-item"> Deactived: 40 </li>`;
    } 
	
    else if (type === 'nilrefill') {
        title.innerText = '🚛 Nil-refill List';
        list.innerHTML = `
            <li class="list-group-item"> Less than 6 months.</li>
			<ul>
			<li> No of Area: 25</li> 
			<li>Qty : 100</li>
			<li>Percentage: 10% </li>
			<li>Total: 100</li>
			</ul>
            <li class="list-group-item"> Less than 1 Year.</li>
			<ul>
			<li> No of Area: 25</li> 
			<li>Qty : 200</li>
			<li>Percentage : 20%</li>
			<li>Total: 200</li>
			</ul>
			`;
    } 
	else if (type === 'kyc') {
        title.innerText = '⏳ KYC Pending';
        list.innerHTML = `
            <li class="list-group-item">PMUY </li>
			 <li class="list-group-item"> Less than 6 months.</li>
			<ul>
			<li> No of Area: 25</li> 
			<li>Qty : 100</li>
			<li>Percentage: 10% </li>
			<li>Total: 100</li>
			</ul>
            <li class="list-group-item"> Less than 1 Year.</li>
			<ul>
			<li> No of Area: 25</li> 
			<li>Qty : 200</li>
			<li>Percentage : 20%</li>
			<li>Total: 200</li>
			</ul>
			`;
    } 
	else if (type === 'hose-due') {
        title.innerText = '🏭 Hose-Due';
        list.innerHTML = `
            <li class="list-group-item">PMUY </li>
			<ul>
			<li> No of Area: 25</li> 
			<li>Qty : 100</li>
			<li>Percentage: 10% </li>
			<li>Total: 100</li>
			</ul>
            <li class="list-group-item">Non-PMUY </li>
			<ul>
			<li> No of Area: 25</li> 
			<li>Qty : 200</li>
			<li>Percentage : 20%</li>
			<li>Total: 200</li>
			</ul>
			`;
    } 
	else if (type === 'mi-due') {
        title.innerText = '📈 MI-Due';
        list.innerHTML = `
            <li class="list-group-item">PMUY </li>
			<ul>
			<li> No of Area: 25</li> 
			<li>Qty : 100</li>
			<li>Percentage: 10% </li>
			<li>Total: 100</li>
			</ul>
            <li class="list-group-item">Non-PMUY </li>
			<ul>
			<li> No of Area: 25</li> 
			<li>Qty : 200</li>
			<li>Percentage : 20%</li>
			<li>Total: 200</li>
			</ul>`;
    } 
    // else if (type === 'kyc') {
    //     title.innerText = '📉 Expense Report';
    //     list.innerHTML = `
    //         <li class="list-group-item">Rent: 💲1,500</li>
    //         <li class="list-group-item">Utilities: 💲800</li>`;
    // } 
    else if (type === 'mobileno') {
        title.innerText = '📈 Mobileno';
        list.innerHTML = `
            <li class="list-group-item">PMUY </li>
			<ul>
			<li> No of Area: 25</li> 
			<li>Qty : 100</li>
			<li>Percentage: 10% </li>
			<li>Total: 100</li>
			</ul>
            <li class="list-group-item">Non-PMUY </li>
			<ul>
			<li> No of Area: 25</li> 
			<li>Qty : 200</li>
			<li>Percentage : 20%</li>
			<li>Total: 200</li>
			</ul>`;
    }

    detailsSection.style.display = 'block';
}
        
        // Add expand/collapse effect to icons into dashboard
        document.querySelectorAll(".dashboard-card").forEach(card => {
            card.addEventListener("click", function() {
                let icon = this.querySelector(".expand-icon");
                icon.classList.toggle("expand");
            });
        });
    </script>

