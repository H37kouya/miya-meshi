import firebase from 'firebase'
import { Keyword, KEYWORD_TYPE } from '@/src/types/Keyword'
import { firestoreDocDataToMenu } from '~/src/infra/firestore/Menu'

const KEYWORDS_COLLECTION_NAME = 'keywords'

/**
 * Menuを削除する
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } id
 */
export const deleteKeyword = async (
  $fireStore: firebase.firestore.Firestore,
  id: string
) => {
  await $fireStore.collection(KEYWORDS_COLLECTION_NAME).doc(id).delete()
}

export const getKeywordList = async (
  $fireStore: firebase.firestore.Firestore
) => {
  const list = await $fireStore.collection(KEYWORDS_COLLECTION_NAME).get()

  const keywords = [] as Keyword[]
  list.forEach((doc) => {
    keywords.push(firestoreDocDataToKeyword(doc))
  })
  return keywords
}

/**
 * Keywordの取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } id
 */
export const getKeywordByID = async (
  $fireStore: firebase.firestore.Firestore,
  id: string
) => {
  const doc = await $fireStore.collection(KEYWORDS_COLLECTION_NAME).doc(id).get()
  return firestoreDocDataToKeyword(doc)
}

/**
 * FirebaseのデータをKeyword型に変換
 *
 * @param { firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot } doc
 */
export const firestoreDocDataToKeyword = (
  doc: firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot
) => {
  const docData = doc.data()

  return {
    type: KEYWORD_TYPE,
    id: doc.id,
    ...docData
  } as Keyword
}
