import firebase from 'firebase'
import { Area } from '@/lib/types/Area'
import { Type } from '@/lib/enum'

const AREA_COLLECTION_NAME = 'areas'

export const getAreaList = async (
  $fireStore: firebase.firestore.Firestore
) => {
  const list = await $fireStore.collection(AREA_COLLECTION_NAME).get()

  const areas = [] as Area[]
  list.forEach((doc) => {
    areas.push(firestoreDocDataToArea(doc))
  })
  return areas
}

/**
 * Areaの取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } id
 */
export const getAreaByID = async (
  $fireStore: firebase.firestore.Firestore,
  id: string
) => {
  const doc = await $fireStore.collection(AREA_COLLECTION_NAME).doc(id).get()
  return firestoreDocDataToArea(doc)
}

/**
 * FirebaseのデータをArea型に変換
 *
 * @param { firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot } doc
 */
export const firestoreDocDataToArea = (
  doc: firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot
) => {
  const docData = doc.data()

  return {
    type: Type.AREA,
    id: doc.id,
    ...docData
  } as Area
}
