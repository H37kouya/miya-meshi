import firebase from 'firebase'
import { Dish } from '@/lib/types/Dish'
import { Type } from '@/lib/enum'

const DISH_COLLECTION_NAME = 'dishes'

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
