/**
 * shop.menuImageLinkを'no-image.png'で配列を埋めるコマンド
 */

import 'firebase/firestore'
import * as admin from 'firebase-admin'
const serviceAccount = require('../../serviceAccount.json')
require('dotenv').config()

const DEFAULT_IMAGE = '/no-image.png'

admin.initializeApp({
  credential: admin.credential.cert(serviceAccount),
  databaseURL: process.env.FIREBASE_ADMIN_DATABASE_URL,
  projectId: process.env.FIREBASE_PROJECT_ID
});
const firestore = admin.firestore()

const handler = async () => {
  const collection = firestore.collection('shops')
  const docQuery = await collection.get()

  docQuery.forEach((doc) => {
    const docID = doc.id
    const data = doc.data()

    let newMenuImageLink = []
    if (Array.isArray(data.menuImageLink) && data.menuImageLink.length < 5) {
      newMenuImageLink = data.menuImageLink
      for (let i = newMenuImageLink.length; i < 6; i++) {
        newMenuImageLink.push(DEFAULT_IMAGE)
      }

      console.log(`進行中：${doc.id}`)
      console.log(newMenuImageLink)
      collection.doc(docID).update({
        menuImageLink: newMenuImageLink
      })
    }
  })
}

(async () => {
  await handler()
}) ()
