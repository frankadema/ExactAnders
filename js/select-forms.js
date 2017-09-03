//  Frank Adema
//  Student Stenden Emmen
//  frank.adema@student.stenden.com
//  leerlingnummer: 277665
//  Jaar: 2017
//  Afstudeeropdracht Exact Anders

//inlever titels
var inlevermomentTitles =
[
  "1e inlevermoment",
  "definitive inlevermoment",
]

function AssignmentHandler(props)
{
  this.props = props

  this.hideAll()

  this.props.selectOpdracht.on('change', this.onOpdrachtChange.bind(this))
}

AssignmentHandler.prototype.hideAll = function()
{
  this.setZichtbaarheid('inlevermoment', false)
  this.setZichtbaarheid('cijfer', false)
  this.setZichtbaarheid('bestand', false)
  this.setZichtbaarheid('error', false)
}

//Conolse log
AssignmentHandler.prototype.getDataFromApi = function(opdrachtID)
{
  console.log( { 'leerling_id': leerlingID, 'vak_id': vakID, 'vak_huiswerk_id': opdrachtID })
  $.post(this.props.api, { 'leerling_id': leerlingID, 'vak_id': vakID, 'vak_huiswerk_id': opdrachtID })
  .done(this.onApiSuccess.bind(this))
  .fail(this.onApiError.bind(this))
}

//JSON icm zichtbaarheid
AssignmentHandler.prototype.onApiSuccess = function(json)
{
  console.log('Response from server: ', json)
  var data = JSON.parse(json)

  var inleverMoment = data.inlevermoment

  if(inlevermomentTitles[inleverMoment]){
    this.props.inlevermomentText.text(inlevermomentTitles[inleverMoment])
    this.props.inlevermomentValue.attr('value', parseInt(inleverMoment, 10) + 1)

    this.setZichtbaarheid('inlevermoment', true)
    this.setZichtbaarheid('cijfer', true)
    this.setZichtbaarheid('bestand', true)
  }
  else
  {
    this.setZichtbaarheid('error', true)
  }
}

//error report
AssignmentHandler.prototype.onApiError = function(e, a, b, c)
{
  console.log('Api error', e, a, b, c)
}

//OpdractID binnenhalen
AssignmentHandler.prototype.onOpdrachtChange = function()
{
  this.hideAll()
  var opdrachtID = this.props.selectOpdracht.val()

  if(opdrachtID === '0')
  {
    this.hideAll()
    return this
  }

  this.getDataFromApi(opdrachtID)
}

//zichtbaarheid
AssignmentHandler.prototype.setZichtbaarheid = function(name, zichtbaar = true)
{
  if(zichtbaar)
  {
    this.props[name].show()
  }else{
    this.props[name].hide()
  }
}

// Huiswerk
new AssignmentHandler(
  {
    api: 'http://tech.hrce.nl/api-1.php',
    selectOpdracht: $('#hw-opdracht-select'),
    inlevermoment: $('#hw-inlevermoment'),
    inlevermomentValue: $('#hw-inlevermoment-value'),
    inlevermomentText: $('#hw-inlevermoment-text'),
    cijfer: $('#hw-cijfer'),
    bestand: $('#hw-bestand'),
    error: $('#hw-error'),
  })

  // Groepsopdrachten
  new AssignmentHandler(
    {
      api: 'http://tech.hrce.nl/api-2.php',
      selectOpdracht: $('#gw-opdracht-select'),
      inlevermoment: $('#gw-inlevermoment'),
      inlevermomentValue: $('#gw-inlevermoment-value'),
      inlevermomentText: $('#gw-inlevermoment-text'),
      cijfer: $('#gw-cijfer'),
      bestand: $('#gw-bestand'),
      error: $('#gw-error'),
    })
