import React, { useState } from 'react'

export default function Answer({ total_player, player_card_list, remaining_list }) {


  return (
    <div>
      <h1>Game details</h1>
      <h2>Total players: { total_player }</h2>
      <h2>Current player cards:</h2>
      {
        Object.values(player_card_list).map((card, index)=> {
          return <div key={index}>Player_{index+1} : {card}</div>
        })
      }
      <br />
      <br />
      <h2>Current Remaining Card</h2>
      {
        Object.values(remaining_list).length > 0 && remaining_list
      }
    </div>
  )
}
