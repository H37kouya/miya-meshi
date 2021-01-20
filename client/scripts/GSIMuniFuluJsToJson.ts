// @ts-nocheck
const fs = require('fs')
const GSI: { [key: string]: string } = require('../assets/json/muni-fulu.js')

const handler = () => {
  const gsi = GSI
  fs.writeFileSync('../assets/json/muni-fulu.json', JSON.stringify(gsi, null, '\t'))
  fs.writeFileSync('../../admin/assets/json/muni-fulu.json', JSON.stringify(gsi, null, '\t'))
}

handler()
