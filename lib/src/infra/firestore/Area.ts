import firebase from 'firebase'
import { Area } from '../../../types/Area'
import { Type } from '../../../enum'
import { removeUndefinedFromObject } from '../../utils/Object'

const AREA_COLLECTION_NAME = 'areas'

/**
 * Shopを追加する
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { typeof firebase.firestore } $fireStoreObj
 * @param { Area } area
 */
export const createArea = async (
  $fireStore: firebase.firestore.Firestore,
  $fireStoreObj: typeof firebase.firestore,
  area: Area
) => {
  const addData = {
    ...removeUndefinedFromObject(area),
    createdAt: $fireStoreObj.FieldValue.serverTimestamp(),
    updatedAt: $fireStoreObj.FieldValue.serverTimestamp()
  } as firebase.firestore.DocumentData

  await $fireStore.collection(AREA_COLLECTION_NAME).add(addData)
}

/**
 * Areaを編集する
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { typeof firebase.firestore } $fireStoreObj
 * @param { Area } area
 * @param { Area['id'] } areaID
 */
export const editArea = async (
  $fireStore: firebase.firestore.Firestore,
  $fireStoreObj: typeof firebase.firestore,
  area: Area,
  areaID: Area['id']
) => {
  const updateData = {
    ...removeUndefinedFromObject(area),
    updatedAt: $fireStoreObj.FieldValue.serverTimestamp()
  }

  await $fireStore.collection(AREA_COLLECTION_NAME).doc(areaID).update(updateData)
}

/**
 * Areaを削除する
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } id
 */
export const deleteArea = async (
  $fireStore: firebase.firestore.Firestore,
  id: string
) => {
  await $fireStore.collection(AREA_COLLECTION_NAME).doc(id).delete()
}

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
