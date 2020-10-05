/**
 * shop listを取得する
 */

import 'firebase/firestore'
import * as admin from 'firebase-admin'
import fs from 'fs'
import { getTimeStamp } from '../../src/utils/Data'
import { Collection } from '../../lib/enum/Collection'
const serviceAccount = require('../../serviceAccount.json')
require('dotenv').config()

admin.initializeApp({
  credential: admin.credential.cert(serviceAccount),
  databaseURL: process.env.FIREBASE_ADMIN_DATABASE_URL,
  projectId: process.env.FIREBASE_PROJECT_ID
});
const firestore = admin.firestore()

const handler = async () => {
  const collection = firestore.collection(Collection.DISHES)
  const docQuery = await collection.get()
  const data = convertToData(docQuery)
  const timestamp = getTimeStamp()

  fs.writeFileSync(
    `./assets/backup/dish_list/${timestamp}_dish_list.json`,
    JSON.stringify(data, undefined, ' ')
  )
}

const convertToData = (docQuery: FirebaseFirestore.QuerySnapshot) => {
  const data = [] as any[]

  docQuery.forEach((doc) => {
    data.push({
      id: doc.id,
      ...doc.data()
    })
  })

  return data
}

(async () => {
  await handler()
}) ()
