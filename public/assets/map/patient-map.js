const PATIENT_DEFAULT_COORD = [-6.248556684278181, 106.93391665036538]
const PatientresultsWrapperHTML = document.getElementById("patient-search-result")

// initial map
const PatientMap = L.map("patient-render-map")

// initial osm tile url
const patientosmTileUrl = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"

const patientattrib = 'Leaflet with <a href="https://academy.byidmore.com">Id More Academy<a>'

const patientosmTile = new L.TileLayer(patientosmTileUrl, { minZoom: 2, maxZoom: 20, attribution: patientattrib })

// add layer
// https://leafletjs.com/reference-1.6.0.html#layer
PatientMap.setView(new L.LatLng(PATIENT_DEFAULT_COORD[0], PATIENT_DEFAULT_COORD[1]), 15)
PatientMap.addLayer(patientosmTile)

// add marker
// https://leafletjs.com/reference-1.6.0.html#marker
const PatientMarker = L.marker(PATIENT_DEFAULT_COORD).addTo(PatientMap)

// click listener
// https://leafletjs.com/reference-1.6.0.html#evented
PatientMap.on("click", function(e){
  const {lat, lng} = e.latlng
  // regenerate marker position
  PatientMarker.setLatLng([lat, lng])
})

// search location handler
let PatienttypingInterval

// typing handler
function PatientonTyping(e) {
  clearInterval(PatienttypingInterval)
  const {value} = e

  PatienttypingInterval = setInterval(() => {
    clearInterval(PatienttypingInterval)
    PatientsearchLocation(value)
  }, 500)
}

// search handler
function PatientsearchLocation(keyword) {
  if(keyword) {
    // request to nominatim api
    fetch(`https://nominatim.openstreetmap.org/search?q=${keyword}&format=json`)
      .then((response) => {
        return response.json()
      }).then(json => {
       // get response data from nominatim
       console.log("json", json)
        if(json.length > 0) return PatientrenderResults(json)
        else document.getElementById('patient-location-notfound').text = 'Lokasi Tidak Di Temukan';
    })
  }
}

// render results
function PatientrenderResults(result) {
  let resultsHTML = ""

  result.map((n) => {
    resultsHTML += `<li class="address_list"><a href="#" id="patient_district_list${n.lat}" onclick="PatientsetLocation(${n.lat},${n.lon});">${n.display_name}</a></li>`
  })

  PatientresultsWrapperHTML.innerHTML = resultsHTML
}

// clear results
function PatientclearResults() {
  PatientresultsWrapperHTML.innerHTML = ""
}

// set location from search result
function PatientsetLocation(lat, lon) {
  // set map focus
  PatientMap.setView(new L.LatLng(lat, lon), 15)
  document.getElementById('patient_lat').value = lat;
  document.getElementById('patient_lon').value = lon;
  document.getElementById('patient_district').value = document.getElementById('patient_district_list'+lat).text;

  // regenerate marker position
  PatientMarker.setLatLng([lat, lon])

  // clear results
  PatientclearResults()
}
