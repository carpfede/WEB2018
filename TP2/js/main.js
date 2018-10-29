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
  let body = document.getElementsByTagName("tbody")[0];
  body.innerHTML = "";
  array.forEach(element => {
    let row = `<tr>
      <td>${element.id.name}</td>
      <td>${element.id.value ? element.id.value : "s/n"}</td>
      <td>${element.name.title}</td>
      <td>${element.name.last}</td>
      <td>${element.name.first}</td>
      <td>${element.gender}</td>
      <td>${element.dob.age}</td>
      <td>${new Date(element.dob.date).toLocaleDateString("es")}</td>
      <td>${element.location.city}</td>
      <td>${element.location.state}</td>
      <td>${element.location.street}</td>
      <td>${element.cell}</td>
      <td>${element.phone}</td>
      <td>${element.email}</td>
      <td>${element.login.username}</td>
      <td>${element.login.password}</td>
      <td><a href=${element.picture.large}>Image</a></a></td>
      </tr>`;
    body.innerHTML = body.innerHTML.concat(row);
  });
}

function filterArray(value) {
  if (value) {
    let filterArray = array.filter(e => {
      return (
        e.gender === value ||
        e.name.first.includes(value) ||
        e.name.last.includes(value)
      );
    });
    fillTable(filterArray);
  } else {
    fillTable(array);
  }
}
