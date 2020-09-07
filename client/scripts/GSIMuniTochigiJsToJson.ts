const fs = require('fs')
const GSI: { [key: string]: string } = require('../assets/json/muni-tochigi.js')

const handler = () => {
  const gsi = GSI
  fs.writeFileSync('../assets/json/muni-tochigi.json', JSON.stringify(gsi, null, '\t'))
  fs.writeFileSync('../../admin/assets/json/muni-tochigi.json', JSON.stringify(gsi, null, '\t'))
}

handler()
