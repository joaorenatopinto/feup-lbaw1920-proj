// CATEGORY ITEMS PAGE 

function paginationHandler(event) {
  event.preventDefault();

  let categoryId = document.getElementById('category_auctions').getAttribute('data-id');
  let pageId;

  //Find the page
  if (event.target.innerText == '‹') {
    //Get current page
    pageId = Number(document.querySelector('#auction_cards li.active').children[0].innerText) - 1;
  }
  else if (event.target.innerText == '›') {
    pageId = Number(document.querySelector('#auction_cards li.active').children[0].innerText) + 1;
  }
  else {
    pageId = event.target.innerText;
  }

  sendAjaxRequest('get', '/api/category/' + categoryId + '?' + encodeForAjax({page: pageId}) , null, paginationResponseHandler);
}

function paginationResponseHandler() {
  if (this.status != 200) {
    window.location = '/';
  }

  let response = JSON.parse(this.responseText);
  let auctions = response.auctions.data;
  //clear auction cards
  let auction_cards =  document.getElementById('auction_cards');
  auction_cards.innerHTML = '';

  //Add the auction cards
  for (let i = 0; i < auctions.length; i++) {
    let auction = auctions[i];
    let newAuctionCard = document.createElement('div');
    let auctionImage = response.images[auction.id];

    newAuctionCard.className = 'col-sm-4 p-0 card';
    newAuctionCard.innerHTML = `
    <img class="card-img-top" src="${auctionImage.path}" height="200" alt="${auctionImage.alt}">
    <div class="card-body">
        <h5 class="card-title">  ${auction.title} </h5>
        <p class="card-text"> ${auction.description}</p>
        <p class="card-text mt-auto"> ${auction.closedate} </p>
        <h3><a href="/auction/${auction.id}" class="btn btn-primary" style="width: 10rem;">BID NOW</a> <span
                    class="badge">${response.bids[auction.id]} €</span></h3>
    </div>
    `;



    auction_cards.appendChild(newAuctionCard);
  }

  let pagDiv = document.getElementById('pag');
  pagDiv.innerHTML = '';

  //Add the pagination
  let pagination = document.createElement('nav');
  pagDiv.appendChild(pagination);

  let paginationList = document.createElement('ul');
  paginationList.className = "pagination";

  //Add the previews button
  if (response.auctions.current_page != 1) {
    paginationList.innerHTML += '<li class="page-item"><a class="page-link" href="#">‹</a></li>';
  }
  else {
    paginationList.innerHTML += '<li class="page-item disabled"><a class="page-link" href="#">‹</a></li>';
  }

  for (let i = 1; i <= response.auctions.last_page; i++) {
    if (i == response.auctions.current_page) {
      paginationList.innerHTML += `<li class="page-item active"><a class="page-link" href="#">${i}</a></li>`;
    }
    else {
      paginationList.innerHTML += `<li class="page-item"><a class="page-link" href="#">${i}</a></li>`;
    }
  }

  //Add the next button
  if (response.auctions.current_page != response.auctions.last_page) {
    paginationList.innerHTML += '<li class="page-item"><a class="page-link" href="#">›</a></li>';
  }
  else {
    paginationList.innerHTML += '<li class="page-item disabled"><a class="page-link" href="#">›</a></li>';
  }

  pagination.appendChild(paginationList);

  addPaginationEventListener();
}

function addPaginationEventListener() {
  let pagination = document.querySelectorAll('.pagination a');

  for (let i = 0; i < pagination.length; i++) {
    pagination[i].addEventListener('click',paginationHandler);
  }
}

addPaginationEventListener();