<?php
	class QQN {
		/**
		 * @return QQNodeRooms
		 */
		static public function Rooms() {
			return new QQNodeRooms('rooms', null, null);
		}
		/**
		 * @return QQNodeTracks
		 */
		static public function Tracks() {
			return new QQNodeTracks('tracks', null, null);
		}
		/**
		 * @return QQNodeUsers
		 */
		static public function Users() {
			return new QQNodeUsers('users', null, null);
		}
	}
?>