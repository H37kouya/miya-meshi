import firebase from 'firebase'
import { Dish } from '@/lib/types/Dish'
import { Type } from '@/lib/enum'
import { removeUndefinedFromObject } from '@/src/utils/Object'

const DISH_COLLECTION_NAME = 'dishes'

export const createDish = async (
  $fireStore: firebase.firestore.Firestore,
  $fireStoreObj: typeof firebase.firestore,
  dish: Dish
) => {
  const addData = {
    ...removeUndefinedFromObject(dish),
    createdAt: $fireStoreObj.FieldValue.serverTimestamp(),
    updatedAt: $fireStoreObj.FieldValue.serverTimestamp()
  } as firebase.firestore.DocumentData

  await $fireStore.collection(DISH_COLLECTION_NAME).add(addData)
}

/**
 * Menuを削除する
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } id
 */
export const deleteDish = async (
  $fireStore: firebase.firestore.Firestore,
  id: string
) => {
  await $fireStore.collection(DISH_COLLECTION_NAME).doc(id).delete()
}

export const editDish = async (
  $fireStore: firebase.firestore.Firestore,
  $fireStoreObj: typeof firebase.firestore,
  dish: Dish,
  id: string
) => {
  await $fireStore.collection(DISH_COLLECTION_NAME).doc(id).update({
    ...removeUndefinedFromObject(dish),
    updatedAt: $fireStoreObj.FieldValue.serverTimestamp()
  })
}

export const getDishList = async (
  $fireStore: firebase.firestore.Firestore
) => {
  const list = await $fireStore.collection(DISH_COLLECTION_NAME).get()

  const dishes = [] as Dish[]
  list.forEach((doc) => {
    dishes.push(firestoreDocDataToDish(doc))
  })
  return dishes
}

/**
 * Dishの取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } id
 */
export const getDishByID = async (
  $fireStore: firebase.firestore.Firestore,
  id: string
) => {
  const doc = await $fireStore.collection(DISH_COLLECTION_NAME).doc(id).get()
  return firestoreDocDataToDish(doc)
}

/**
 * FirebaseのデータをDish型に変換
 *
 * @param { firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot } doc
 */
export const firestoreDocDataToDish = (
  doc: firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot
) => {
  const docData = doc.data()

  return {
    type: Type.DISH,
    id: doc.id,
    ...docData
  } as Dish
}
