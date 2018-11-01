const url = "https://randomuser.me/api/?results=500";

let array = [];

fetchAsync(url);

async function fetchAsync(url) {
  array = await fetch(url)
    .then(result => result.json())
    .then(result => {
      return result.results.slice(0, 10);
    });
  fillTable(array);
}

function fillTable(array) {
  let cards = document.getElementById("cards");
  cards.innerHTML = "";
  for (i = 0; i < array.length; i += 2) {
    let elem1 = array[i];
    let row = `
      <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                            <img src="${
                              elem1.picture.large
                            }" class="rounded-circle"alt="Cinque Terre">
                        </div>
                    </div>
                    <div class="card-body">
                      <h3 class="text-capitalize">${elem1.name.first} ${
      elem1.name.last
    }</h3>
                      <label><b>Usuario</b>: ${
                        elem1.login.username
                      }</label><br/>
                      <label><b>Email</b>: ${elem1.email}</label><br/>
                      <label><b>Tel&eacutefono</b>: ${elem1.cell}</label>   
                    </div>
                </div>
            </div>
        </div>`;
    let elem2 = array[i + 1];
    if (elem2) {
      let str = `
      <div class="col-sm-6">
        <div class="form-group">
          <div class="card">
              <div class="card-header">
                  <div class="text-center">
                      <img src="${
                        elem2.picture.large
                      }" class="rounded-circle"alt="Cinque Terre">
                  </div>
              </div>
              <div class="card-body">
                <h3 class="text-capitalize">${elem2.name.first} ${
        elem2.name.last
      }</h3>
                <label><b>Usuario</b>: ${elem2.login.username}</label><br/>
                <label><b>Email</b>: ${elem2.email}</label><br/>
                <label><b>Tel&eacutefono</b>: ${
                  elem2.cell
                }</label>                     
              </div>
          </div>
        </div>
      </div>`;
      row = row + str;
    }
    row.concat("</div>");
    cards.innerHTML = cards.innerHTML.concat(row);
  }
}

function filterArray() {
  let name = document.getElementById("name").value.trim();
  let gender = document.getElementById("gender").value;
  let filterArray = array.filter(e => {
    return (
      (!gender || e.gender === gender) &&
      (!name || e.name.first.concat(" ", e.name.last).includes(name))
    );
  });
  fillTable(filterArray);
}
