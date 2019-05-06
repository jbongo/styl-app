const puppeteer = require('puppeteer')
const fs = require('fs')

/*
// 2 - Récupération des URLs de toutes les pages à visiter
- waitFor("body"): met le script en pause le temps que la page se charge
- document.querySelectorAll(selector): renvoie tous les noeuds qui vérifient le selecteur
- [...document.querySelectorAll(selector)]: caste les réponses en tableau
- Array.map(link => link.href): récupère les attributs href de tous les liens
*/

const getAllUrl = async browser => {
  const page = await browser.newPage({'args' : [ '--disable-dev-shm-usage' ]})
  await page.goto('https://www.notaires.fr/fr/annuaire-offices-departement?field_department_value=030&field_geofield_distance%5Borigin%5D=d%C3%A9partement+Gard')
  await page.waitFor('body')
  const iter = await page.evaluate(() =>{
    return parseInt(((parseInt(document.querySelector('#block-system-main > div > h1 > em').textContent)) / 10) + 1)
  })
  for(var x=0; x<=iter; x++)
  {
    await page.click("#block-system-main > div > div.item-list > ul > li > a")
    await page.waitFor(5000)
  }
  const result = await page.evaluate(() =>
    [...document.querySelectorAll('#block-system-main > div > div.body-result-search.clearfix.view-content > div > ul > li > a')].map(link => link.href),
  )
  return result
}

function chunkArray(myArray, chunk_size){
  var index = 0;
  var arrayLength = myArray.length;
  var tempArray = [];
  
  for (index = 0; index < arrayLength; index += chunk_size) {
      myChunk = myArray.slice(index, index+chunk_size);
      tempArray.push(myChunk);
  }

  return tempArray;
}

const getDataFromUrl = async (browser, url) => {
  const page = await browser.newPage()
  await page.goto(url, {})
  await page.waitFor('body')
  const result = await page.evaluate(async (e) => {
    let etude = null
    let addr = (document.querySelector("#collapse002 > div > span > p:nth-child(1)").textContent).split('\n')
    let addr2 = []
    for(let i=0; i<addr.length; i++)
    {
      let tmp = addr[i].trim()
      if(tmp !== "")
        addr2.push(tmp)
    }
    let mail = ""
    if(document.querySelector("#bleu-color > a"))
      mail = document.querySelector("#bleu-color > a").textContent
    let concat = ""
    for (let i = 0; i < addr2.length - 1; i++){
      concat = (concat.concat(" ".concat(addr2[i]))).trim()
    }
    etude = {
      role: "etude",
      nom: document.querySelector("#heading002 > h1 > a").textContent.trim(),
      adresse: concat,
      code_postal: addr2[addr2.length - 1].substr(0, 5),
      ville: addr2[addr2.length - 1].substr(8, addr2[addr2.length - 1].length),
      telephone: (((document.querySelector("#collapse002 > div > span > p:nth-child(2)").textContent).trim()).substr(11, 26)).replace(/^\s+|\s+$/g,''),
      email: mail,
      notaire: {
        role: "notaire",
        nom: document.querySelector("#collapse001 > div > h1").textContent.trim(),
        telephone: (((document.querySelector("#collapse001 > div > p:nth-child(3)").textContent).trim()).substr(11, 26)).replace(/^\s+|\s+$/g,''),
        email: mail
      }
    }
    let link = [...document.querySelectorAll('#collapse002 > div > span > a')].map(link => link.href)
    return {etude, link}
  })
  await page.close()
  return result
}

const getNotaireFromUrl = async (browser, url) => {
  const page = await browser.newPage()
  await page.goto(url, {})
  await page.waitFor('body')
  const ret = await page.evaluate(async (e) => {
    let associe = null
    let mail = ""
    if(document.querySelector("#bleu-color > a"))
      mail = document.querySelector("#bleu-color > a").textContent
    associe = {
      role: "notaire",
      nom: document.querySelector("#collapse001 > div > h1").textContent.trim(),
      telephone: (((document.querySelector("#collapse001 > div > p:nth-child(3)").textContent).trim()).substr(11, 26)).replace(/^\s+|\s+$/g,''),
      email: mail
    }
    return { associe }
  })
  await page.close()
  return ret
}

const scrap = async () => {
  console.log("Init process")
  const browser = await puppeteer.launch({ headless: false })
  console.log("Web socket connexion was accepted by target !")
  console.log("Process fetch URL map")
  const tmp = await getAllUrl(browser)
  const urlList = chunkArray(tmp, 10)
  console.log(urlList)
  var results = {
    ftPush: function ftPush (elem) {
        [].push.call(this, elem);
    }  
  }
  for (let i = 0; i < urlList.length ; i ++)
  {
    const ret = await Promise.all(
      (urlList[i]).map(url => getDataFromUrl(browser, url)),
    )
    console.log(ret)
    for(let j = 0; j < ret.length; j++){
      if(ret[j].link){
        let notaire = await Promise.all(
            (ret[j].link).map(url => getNotaireFromUrl(browser, url)),
        )
        console.log(notaire)
        let associe = ret[j].etude.notaire
        var tet = {associe}
        notaire.push(tet)
        delete ret[j].etude.notaire
        var obj = {
          etude: ret[j].etude,
          associes: notaire
        }
        results.ftPush(obj)
      }
    }
  }
  browser.close()
  return results
}

// 5 - Appel la fonction `scrap()`, affiche les résulats et catch les erreurs
scrap()
  .then(value => {
    var fls = fs.createWriteStream('gard.json')
    fls.write(JSON.stringify(value))
    fls.end();
  })
  .catch(e => console.log(`error: ${e}`))