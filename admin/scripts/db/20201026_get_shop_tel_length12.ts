/**
 * shop.telで電話番号が12桁のものを取得
 */

import 'firebase/firestore'
import * as admin from 'firebase-admin'
import fs from 'fs'
const serviceAccount = require('../../serviceAccount.json')
require('dotenv').config()

admin.initializeApp({
  credential: admin.credential.cert(serviceAccount),
  databaseURL: process.env.FIREBASE_ADMIN_DATABASE_URL,
  projectId: process.env.FIREBASE_PROJECT_ID
});
const firestore = admin.firestore()

const exportCsv = (contents: Shop[]) => {
  let str = ''

  str += `店舗名,`
  str += `インスタ番号,`
  str += `電話番号,`
  str += `リンク`
  str += '\n'

  for (const content of contents) {
    str += `${content.name},`
    str += `${content.instaNumber},`
    str += `${content.tel},`
    str += `${process.env.ADMIN_URL}/shops/edit/${content.id}`
    str += '\n'
  }

  fs.writeFile('./assets/csv/shop_tel_list_utf8.csv', str, 'utf8', function (err) {
    if (err) {
      console.log('保存できませんでした');
      console.log(err);
    } else {
      console.log('保存できました');
    }
  });
}


type Shop = {
  id: string
  name: string
  instaNumber: number
  tel: string
}
const handler = async () => {
  const collection = firestore.collection('shops')
  const docQuery = await collection.orderBy('tel').get() // telのカラムがあるもののみを取得
  const shops = [] as Shop[]

  docQuery.forEach((doc) => {
    const docID = doc.id
    const data = doc.data()

    // 12文字か - を含まないもの
    if (data.tel &&
      ((data.tel.indexOf('028') === -1 && data.tel.length === 12))
    ) {
      shops.push({
        id: docID,
        name: data.name,
        instaNumber: data.instaNumber,
        tel: data.tel,
      })
    }
  })

  exportCsv(shops)
}


(async () => {
  await handler()
}) ()
