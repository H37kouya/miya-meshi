import firebase from 'firebase'
import { Menu, MENU_TYPE } from '@/src/types/Menu'

const MENU_COLLECTION_NAME = 'menus'

/**
 * Menu一覧を取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { Number } limit
 */
export const getMenuList = async (
  $fireStore: firebase.firestore.Firestore,
  limit: number = 12
) => {
  const list = await $fireStore.collection(MENU_COLLECTION_NAME).limit(limit).get()

  const menus = [] as Menu[]
  list.forEach((doc) => {
    menus.push(firestoreDocDataToMenu(doc))
  })
  return menus
}

/**
 * ShopIDによって、Menu一覧を取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } shopID
 * @param { Number } limit
 */
export const getMenuListByShopID = async (
  $fireStore: firebase.firestore.Firestore,
  shopID: string,
  limit: number = 12
) => {
  const list = await $fireStore
    .collection(MENU_COLLECTION_NAME)
    .where('shopID', '==', shopID)
    .limit(limit)
    .get()

  const menus = [] as Menu[]
  list.forEach((doc) => {
    menus.push(firestoreDocDataToMenu(doc))
  })
  return menus
}

/**
 * Menuの取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } id
 */
export const getMenuByID = async (
  $fireStore: firebase.firestore.Firestore,
  id: string
) => {
  const doc = await $fireStore.collection(MENU_COLLECTION_NAME).doc(id).get()
  return firestoreDocDataToMenu(doc)
}

/**
 * FirebaseのデータをMenu型に変換
 *
 * @param { firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot } doc
 */
export const firestoreDocDataToMenu = (
  doc: firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot
) => {
  const docData = doc.data()

  return {
    type: MENU_TYPE,
    id: doc.id,
    ...docData
  } as Menu
}
